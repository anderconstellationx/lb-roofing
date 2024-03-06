<?php

namespace App\Livewire\Project\Gallery;

use App\Models\GaleriaProyecto;
use App\Models\GalleryReport;
use App\Models\Interaccion;
use App\Models\Proyecto;
use App\Models\Usuario;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Barryvdh\DomPDF\Facade;

class Report extends Component
{
    public $projectId;
    const NAME_DISK_STORAGE = 'gallery_report';
    public string $title = '', $nameFile = '', $to = '', $subject = '', $message = '';
    public int $numberPages = 2;
    #[Modelable]
    public $gallery;
    public bool $showFileGenerated = false;
    public array $fileInfo = [];


    public function render()
    {
        return view('livewire.project.gallery.report');
    }

    public function mount($id)
    {
        $this->projectId = $id;
        $project = Proyecto::find($this->projectId);
        $project->load('usuario_cliente');
        $this->title = __('lang.report_name', ['name'=> $project->titulo, 'date' => date('m-d-Y')]);
        $this->to = $project->usuario_cliente->email;
        $this->subject = $this->title;

    }

    public function saveReport()
    {
        ini_set('max_execution_time', '-1');
        ini_set('memory_limit', '-1');
        $count = count($this->gallery);
        $galleryItemsGrouped = GaleriaProyecto::whereIn('id', $this->gallery)->orderBy('fecha_creacion', 'desc')->get()->load('interaccions', 'proyecto', 'usuario')->chunk($this->numberPages);
        $this->nameFile = self::NAME_DISK_STORAGE . '/' . Str::random(15) . '.pdf';
        $this->fileInfo = pathinfo($this->nameFile);
        $this->message = __('lang.check_out_our_test_report_we_created', ['link' => url($this->nameFile)]);
        GalleryReport::create([
            'title' => $this->title,
            'file' => $this->nameFile,
            'proyecto_id' => $this->projectId,
            'usuario_id' => auth()->user()->id
        ]);
        $title = $this->title;
        $user = Usuario::find(auth()->user()->id);
        $project = Proyecto::find($this->projectId);
        $countImages = $count;
        $numberPages = $this->numberPages;
        // options for pdf
        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        $options->setChroot(public_path());
        $options->set('isRemoteEnabled', true);

        $pdf = Facade\Pdf::loadHtml(view('livewire.project.gallery.view-report', compact(
                'title',
                'user',
                'project',
                'countImages',
                'galleryItemsGrouped',
                'numberPages'
            )
        )->render());
        $pdf->setPaper('a4');
        $pdf->setWarnings(false);
        $pdf->save($this->nameFile);

        $this->showFileGenerated = true;
    }

    public function downloadReport(): BinaryFileResponse
    {
        ini_set('max_execution_time', '-1');
        ini_set('memory_limit', '-1');

        $headers = [
            'Content-Type' => 'application/' . $this->fileInfo['extension'] ?? '',
        ];
        return response()->download($this->nameFile, $this->title . '-' . uniqid() . '.' . $this->fileInfo['extension'], $headers);
    }

    #[On('refresh-show-button-report-gallery')]
    public function updatePostList()
    {
        $this->showFileGenerated = false;
    }

}
