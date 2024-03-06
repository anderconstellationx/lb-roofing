<?php

namespace App\Livewire;

use App\Helpers\GlobalMessage;
use App\Models\EstadoProducto;
use Livewire\Component;
use Illuminate\Support\Str as Slug;


class FormsEstadoProductoNuevo extends Component
{
    use GlobalMessage;
    public $nombre;
    public $slug;
    public $descripcion;

    public function render()
    {
        return view('livewire.forms-estado-producto-nuevo');
    }

    function guardar()
    {
        $this->usuario_id = auth()->user()->id;
        try {
            $this->validate([
            'nombre' => 'required',
        ]);
        }catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->validator->errors()->messages());
        }

        $estado = new EstadoProducto;
        $estado->nombre = $this->nombre;
        $estado->descripcion = $this->descripcion;
        $estado->slug =  Slug::slug($this->nombre);
        $estado->usuario_id = auth()->user()->id;
        $save = $estado->save();
        if ($save) {
            $this->dispatch('refreshDatatable');
            $this->reset(['nombre', 'slug', 'descripcion']);
            $this->globalDispatchSweetAlert();
        };
    }

}
