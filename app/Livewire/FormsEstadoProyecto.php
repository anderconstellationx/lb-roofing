<?php

namespace App\Livewire;

use App\Helpers\GlobalMessage;
use App\Models\ProyectoEstado;
use Illuminate\Support\Str as Slug;
use Livewire\Component;

class FormsEstadoProyecto extends Component
{
    use GlobalMessage;
    public $id;
    public $nombre;
    public $slug;
    public $color = '';
    public $descripcion;
    public $statusInfo;

    protected $listeners = [
        'update-status-project' => 'updateStatusProject'
    ];
    public function render()
    {
        return view('livewire.forms-estado-proyecto');
    }

    public function rules()
    {
        return [
            'nombre' => 'required',
        ];
    }
    public function messages()
    {
        return [];
    }

    public function validationAttributes()
    {
        /*alias*/
        return [
            'nombre' => ''
        ];
    }

    public function guardar()
    {
        $this->validate();

        if ($this->id) {
            $proyectoEstado = $this->statusInfo;
        } else {
            $proyectoEstado = new ProyectoEstado();
        }
        $proyectoEstado->nombre = $this->nombre;
        $proyectoEstado->slug = Slug::slug($this->nombre);
        $proyectoEstado->color = $this->color;
        $proyectoEstado->descripcion = $this->descripcion;
        $proyectoEstado->fecha_creacion = now();
        $proyectoEstado->fecha_modificacion = now();
        $save = $proyectoEstado->save();
        if ($save) {
            $this->dispatch('refreshDatatable');
            $this->reset(['nombre', 'slug', 'descripcion', 'color']);

            $this->dispatch('status-project-created');
            $this->globalDispatchModal('modal-status-project');
            $this->globalDispatchSweetAlert();
        }
    }

    public function updateStatusProject($statusId)
    {
        $this->statusInfo = ProyectoEstado::find($statusId);
        if ($this->statusInfo) {
            $this->id = $this->statusInfo->id;
            $this->nombre = $this->statusInfo->nombre;
            $this->color = $this->statusInfo->color;
            $this->descripcion = $this->statusInfo->descripcion;
        }
    }
}
