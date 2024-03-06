<?php

namespace App\Livewire;

use App\Helpers\GlobalMessage;
use App\Models\City;
use App\Models\Country;
use App\Models\Proyecto;
use App\Models\ProyectoEstado;
use App\Models\State;
use App\Models\TemplateMessage;
use App\Models\Usuario;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;
use Illuminate\Support\Str;
use function Symfony\Component\Translation\t;

class FormsNuevoProyecto extends Component
{
    use GlobalMessage;

    public $titulo;
    public $fechaInicio;
    public $fechaFin;
    public $observaciones;
    public $encargado;
    public $proyectoEstadoId;
    public $clienteId;
    public $direccion;
    public $countryId, $stateId, $cityId;
    // DATA SELECT
    public $estados, $usuarios, $encargados, $clientes, $countries, $states = [], $cities = [];
    protected $listeners = ['actualizarClientes' => 'getUsers'];


    public function render()
    {
        $this->countries = Country::All();
        $this->estados = ProyectoEstado::All();
        $this->usuarios = Usuario::getUsers();
        $this->encargados = $this->usuarios->filter(function ($usuario) {
            return $usuario->rol_id == Usuario::ADMIN || $usuario->rol_id == Usuario::EMPLOYEE;
        });
        $this->clientes = $this->usuarios->filter(function ($usuario) {
            return $usuario->rol_id == Usuario::CLIENT;
        });
        return view('livewire.forms-nuevo-proyecto');
    }

    public function rules()
    {
        return [
            'titulo' => 'required',
            'encargado' => 'required',
            'proyectoEstadoId' => 'required',
            'clienteId' => 'required',
            'direccion' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'titulo.required' => __('lang.this_field_is_required'),
            'encargado.required' => __('lang.this_field_is_required'),
            'proyectoEstadoId.required' => __('lang.this_field_is_required'),
            'clienteId.required' => __('lang.this_field_is_required'),
            'direccion.required' => __('lang.this_field_is_required'),
        ];
    }

    public function validationAttributes()
    {
        /*alias*/
        return [];
    }

    public function guardar()
    {
        $this->proyectoEstadoId = ProyectoEstado::QUOTING;
        $this->validate();
        $proyecto = new Proyecto();
        $proyecto->titulo = $this->titulo;
        $proyecto->enlace_galeria = Str::random(10);
        $proyecto->fecha_inicio = $this->fechaInicio;
        $proyecto->fecha_fin = $this->fechaFin;
        $proyecto->fecha_creacion = now();
        $proyecto->fecha_modificacion = now();
        $proyecto->countries_id = $this->countryId;
        $proyecto->state_id = $this->stateId;
        $proyecto->cities_id = $this->cityId;
        $proyecto->direccion = $this->direccion;
        $proyecto->observaciones = $this->observaciones;
        $proyecto->usuario_id = auth()->user()->id;;
        $proyecto->proyecto_estado_id = $this->proyectoEstadoId;
        $proyecto->usuario_encargado_id = $this->encargado;
        $proyecto->usuario_cliente_id = $this->clienteId;
        $save = $proyecto->save();
        if ($save) {
            $this->dispatch('refreshDatatable');
            $this->reset(['titulo', 'fechaInicio', 'fechaFin', 'observaciones', 'encargado', 'proyectoEstadoId']);
            $this->dispatch('project-created', id: $proyecto->id, title: $proyecto->titulo, status: $proyecto->proyecto_estado_id);
            $this->globalDispatchModal('modal-create-project');
            $this->globalDispatchSweetAlert();
        }
    }

    // CHANGE SELECTS DATA
    public function stateIdUpdate()
    {
        Debugbar::info($this->countryId);
        if ($this->countryId) {
            $this->states = State::where('countries_id', '=', $this->countryId)->get();
        }
    }

    public function citiesIdUpdated()
    {
        Debugbar::info($this->stateId);
        if ($this->stateId) {
            $this->cities = City::where('states_id', '=', $this->stateId)->get();
        }
    }

}
