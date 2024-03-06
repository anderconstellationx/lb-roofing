<?php

namespace App\Livewire\Project;

use App\Helpers\GlobalMessage;
use App\Livewire\FormsNuevaGaleria;
use App\Models\CompartirGaleria;
use App\Models\CompartirGaleriaItem;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Detalle extends Component
{
    use GlobalMessage;
    public array $gallery = [];
    public int $id = 0;
    public bool $showButtonReportGallery = false;
    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('livewire.project.detalle');
    }

    #[On('update-button-report-gallery')]
    public function refreshShowButtonReportGallery($gallery, $showButtonReportGallery)
    {
        $this->gallery = $gallery;
        $this->showButtonReportGallery = $showButtonReportGallery;
    }

    public function shareGallery(): void
    {
        $link = FormsNuevaGaleria::generateLinkShareGalleryComplete($this->id);
        if (!empty($this->gallery)) {
            $shareGallery =  CompartirGaleria::create([
                'proyecto_id' => $this->id
            ]);
            foreach ($this->gallery as $id) {
                CompartirGaleriaItem::create([
                    'compartir_galeria_id' => $shareGallery->id,
                    'galeria_proyecto_id' => $id
                ]);
            }

            $link = FormsNuevaGaleria::generateLinkShareGalleryComplete($shareGallery->link, false);
        }

        $this->globalToastMessage(__('lang.toast.gallery_link_copied'), $link);
    }

    public function closeModalGalleryReport()
    {
        $this->dispatch('refresh-show-button-report-gallery');
    }



}
