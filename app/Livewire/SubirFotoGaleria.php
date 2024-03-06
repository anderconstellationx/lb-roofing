<?php

namespace App\Livewire;

use App\Models\GaleriaProyecto;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class SubirFotoGaleria extends Component
{
    use WithFileUploads;
    public $images;
    public $id;

    public function mount()
    {
        $this->id = request()->route()->parameter('id', 0);;
    }

    public function render()
    {
        return view('livewire.subir-foto-galeria');
    }

    public function uploadFile(Request $request): JsonResponse
    {
        try {
            if ($request->hasFile('files') && $request->get('id')) {
                $projectId = $request->get('id');
                $file = $request->file('files');
                $pathFile = $file->store("projects/{$projectId}", GaleriaProyecto::NAME_DISK_STORAGE);

                if ($pathFile) {
                    $newImageGallery = new GaleriaProyecto();
                    $newImageGallery->nombre = pathinfo($pathFile)['basename'];
                    $newImageGallery->nombre_original = $file->getClientOriginalName();
                    $newImageGallery->path = $pathFile;
                    $newImageGallery->fecha_creacion = now();
                    $newImageGallery->type = $file->getClientMimeType();
                    $newImageGallery->proyecto_id = $projectId;
                    $newImageGallery->usuario_id = auth()->user()->id;
                    return response()->json([
                        'success' => $newImageGallery->save()
                    ]);
                }
            }
        } catch (Throwable $e) {
            report('error to upload file in gallery/project');
            report($e);
        }

        return response()->json([
            'success' => false,
        ]);
    }
}
