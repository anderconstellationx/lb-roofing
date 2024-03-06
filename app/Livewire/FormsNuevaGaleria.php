<?php

namespace App\Livewire;

use App\Helpers\GlobalMessage;
use App\Livewire\Project\Detalle;
use App\Models\CompartirGaleria;
use App\Models\GaleriaProyecto;
use App\Models\Interaccion;
use App\Models\Proyecto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

/*
 * show gallery
 * */
class FormsNuevaGaleria extends Component
{
    use GlobalMessage;
    protected $listeners = [
        'update-gallery-files' => 'getFiles',
    ];

    public int $id;
    public bool $showGalleryComment, $editImage;
    #[Modelable]
    public bool $showButtonReportGallery;
    public array $gallery = [], $gallerySelectAll = [], $gallerySelectImage = [];

    /**
     * $id Project Id
     **/
    public function mount($id, $showGalleryComment, $gallery_items = [], $editImage = false)
    {
        $this->id = $id;
        $this->showGalleryComment = $showGalleryComment;
        $this->editImage = $editImage;

        if (!empty($gallery_items)) {
            $this->gallery = $gallery_items;
        } else {
            $this->getFiles();
        }
    }

    public function render()
    {
        return view('livewire.forms-nueva-galeria', []);
    }


    public function getFiles($refresh = false): array
    {
        $filesProject = GaleriaProyecto::where([
            'proyecto_id' => $this->id,
            'visible' => GaleriaProyecto::VISIBLE
        ])
            ->orderBy('fecha_creacion', 'desc')
            ->get()->toArray();

        $this->gallery = [];
        if ($filesProject) {
            $this->gallery = $this->parseGalleryItems($filesProject);
        }

        if ($refresh) {
            $this->dispatch('refresh-gallery');
        }

        return $this->gallery;
    }

    public function parseGalleryItems($filesProject): array
    {
        $gallery = [];
        foreach ($filesProject as $file) {
            $date = strtotime(date('d-m-Y', strtotime($file['fecha_creacion'])));
            $file['full_path'] = Storage::disk(\App\Models\GaleriaProyecto::NAME_DISK_STORAGE)->url($file['path']).'?v='. uniqid();
            $pathInfo = pathinfo($file['path']);
            $file['filename'] = $pathInfo['filename'] . '.' . $pathInfo['extension'];
            $file['selected'] = false;
            $gallery[$date][] = $file;
        }

        return $gallery;
    }

    public static function formatDate($time): string
    {
        return __('lang.date_format_gallery', [
            'day_string' => Carbon::parse($time)->locale(app()->getLocale())->format('l'),
            'month' => Carbon::parse($time)->locale(app()->getLocale())->format('F'),
            'day' => date('d', $time),
            'year' => date('Y', $time)
        ]);
    }

    public function loadComment(Request $request): JsonResponse
    {
        $idItem = $request->get('id', 0);
        $comments = $this->getComments($idItem);

        return response()->json([
            'html' => view('components.load-comments-gallery', compact('comments', 'idItem'))->render()
        ]);
    }

    public function saveComment(Request $request): JsonResponse
    {
        $idItem = $request->get('id');
        $comment = $request->get('comment');

        if ($idItem && $comment) {
            $newComment = new Interaccion();
            $newComment->usuario_id = auth()->user()->id;
            $newComment->galeria_proyecto_id = $idItem;
            $newComment->comentario = $comment;
            $newComment->fecha_creacion = now();
            $newComment->fecha_modificacion = now();
            $newComment->save();
        }
        $comments = $this->getComments($idItem);
        return response()->json([
            'html' => view('components.load-comments-gallery', compact('comments', 'idItem'))->render()
        ]);
    }

    public function getComments($idItem)
    {
        return Interaccion::where([
            'galeria_proyecto_id' => $idItem
        ])
            ->with('usuario')
            ->orderBy('fecha_creacion', 'desc')
            ->get();
    }

    public function showGallery($idGallery)
    {
        $project = Proyecto::where([
            'enlace_galeria' => $idGallery
        ])->first();

        if (!$project) {
            abort(404);
        }

        $this->id = $project->id;

        View::share('showHeader', false);
        View::share('showSidebar', false);
        return view("livewire.project.show-gallery", [
            'gallery_items' => [],
            'id' => $project->id,
            'title' => env('APP_NAME') . ' - ' . $project->titulo,
            'address' => $project->direccion,
            'showGalleryComment' => false
        ]);
    }

    public function showGalleryItems($idGallery)
    {
        $sharedGallery = CompartirGaleria::where([
            'link' => $idGallery
        ])->first();

        if (!$sharedGallery) {
            abort(404);
        }

        $sharedGallery->load('compartir_galeria_items', 'proyecto');


        $galleryItems = GaleriaProyecto::whereIn('id', $sharedGallery->compartir_galeria_items->pluck('galeria_proyecto_id')->toArray())->get()->toArray();
        $gallery = $this->parseGalleryItems($galleryItems);
        View::share('showHeader', false);
        View::share('showSidebar', false);
        return view("livewire.project.show-gallery", [
            'gallery_items' => $gallery,
            'id' => $sharedGallery->proyecto->id,
            'title' => env('APP_NAME') . ' - ' . $sharedGallery->proyecto->titulo,
            'address' => $sharedGallery->proyecto->direccion,
            'showGalleryComment' => false
        ]);
    }

    public static function generateLinkShareGalleryComplete($id = null, $complete = true): string
    {
        if (!$complete && $id && is_string($id)) {
            return route('show-gallery-items', ['id' => $id]);
        }

        $id = request()->route()->parameter('id', $id);

        if (!$id) {
            return '';
        }

        $project = Proyecto::where([
            'id' => $id
        ])->first();

        return route('show-gallery', ['id' => $project->enlace_galeria]);
    }

    public function checkGalleryAll($key)
    {
        $images = GaleriaProyecto::whereDate('fecha_creacion','=', date('Y-m-d', $key))->orderBy('fecha_creacion', 'desc')->pluck('id')->toArray();
        if (in_array($key, $this->gallerySelectAll)) {
            $this->gallerySelectImage = array_unique(array_merge($this->gallerySelectImage, $images));
        } else {
            $this->gallerySelectImage = array_diff($this->gallerySelectImage, $images);
        }
        $this->gallerySelectImage = array_values($this->gallerySelectImage);

        $this->updateGalleryAndShowButtonReportComponent();
    }

    public function updateGalleryAndShowButtonReportComponent()
    {
        $this->dispatch('update-button-report-gallery', $this->gallerySelectImage, !empty($this->gallerySelectImage))->to(Detalle::class);
    }

    public function updateImageGallery()
    {
        $image = request()->string('image');
        $imageBase64 = request()->string('imageBase64');
        $imageInfo = GaleriaProyecto::where(['nombre' => $image])->first();

        if (!$imageInfo) {
            return response()->json(['success' => false, 'message' => __('lang.toast.gallery_updated_image_failed'), 'color' => 'danger']);
        }

        $imageData = explode('base64,',$imageBase64);
        $imageData = end($imageData);
        $imageData = str_replace(' ', '+', $imageData);
        Storage::disk(GaleriaProyecto::NAME_DISK_STORAGE)->put($imageInfo->path, base64_decode($imageData));
        return response()->json(['success' => true, 'message' => __('lang.toast.gallery_updated_image'), 'color' => 'success']);
    }

    public function changeGallerySelectImage($key)
    {
        if (in_array($key, $this->gallerySelectAll)) {
            $this->gallerySelectAll = array_diff($this->gallerySelectAll, [$key]);
        }
        $this->updateGalleryAndShowButtonReportComponent();
    }

}
