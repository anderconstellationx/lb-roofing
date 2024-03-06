<?php

namespace App\Livewire;

use App\Helpers\GlobalMessage;
use App\Models\City;
use App\Models\Country;
use App\Models\Proyecto;
use App\Models\ProyectoEstado;
use App\Models\State;
use App\Models\Usuario;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Routing\Route;
use Livewire\Component;
use Illuminate\Http\Request;


class FormsEditarProyecto extends Component
{
    use GlobalMessage;

    public int $id;
    public $proyecto;
    public $encargados;
    public $clientes;
    public $estados;
    public $titulo;
    public $enlaceGaleria;
    public $fechaInicio;
    public $fechaFin;
    public $observaciones;
    public $encargado;
    public $proyectoEstadoId;
    public $clienteId;
    public $countryId, $stateId, $cityId;
    public $countries, $states, $cities;
    public $direccion;
    const ADMIN = 1;
    const ENCARGADO = 2;
    const CLIENTE = 4;

    public function mount($id)
    {
        $this->id = $id;
        $this->proyecto = Proyecto::findOrFail($this->id);
        $this->countries = Country::all();
        $this->states = [];
        $this->cities = [];
        $this->countryId = $this->proyecto->countries_id;
        $this->stateId = $this->proyecto->state_id;
        $this->cityId = $this->proyecto->cities_id;
        $this->titulo = $this->proyecto->titulo;
        $this->enlaceGaleria = $this->proyecto->enlace_galeria;
        $this->fechaInicio = $this->proyecto->fecha_inicio;
        $this->fechaFin = $this->proyecto->fecha_fin;
        $this->observaciones = $this->proyecto->observaciones;
        $this->encargado = $this->proyecto->usuario_encargado_id;
        $this->proyectoEstadoId = $this->proyecto->proyecto_estado_id;
        $this->clienteId = $this->proyecto->usuario_cliente_id;
        $this->direccion = $this->proyecto->direccion;
    }

    public function render()
    {
        $this->encargados = Usuario::where('rol_id', self::ADMIN)->orWhere('rol_id', self::ENCARGADO)->get();
        $this->clientes = Usuario::where('rol_id', self::CLIENTE)->get();
        $this->estados = ProyectoEstado::all();
        return view('livewire.forms-editar-proyecto');
    }

    public function actualizar()
    {
        $proyecto = Proyecto::find($this->id);
        $update = $proyecto->update([
            'titulo' => $this->titulo,
            'enlace_galeria' => $this->enlaceGaleria,
            'fecha_inicio' => $this->fechaInicio,
            'fecha_fin' => $this->fechaFin,
            'direccion' => $this->direccion,
            'observaciones' => $this->observaciones,
            'usuario_encargado_id' => $this->encargado,
            'proyecto_estado_id' => $this->proyectoEstadoId,
            'usuario_cliente_id' => $this->clienteId,
            'country_id' => $this->countryId,
            'state_id' => $this->stateId,
            'city_id' => $this->cityId
        ]);
        if ($update) {
            $this->globalDispatchSweetAlert();
        }
    }

    public function stateIdUpdate()
    {
        Debugbar::info($this->countryId);
        if ($this->countryId) {
            $this->states = State::where('countries_id', '=', $this->countryId)->get();
        }
    }

    public function citiesIdUpdated()
    {
        if ($this->stateId) {
            $this->cities = City::where('states_id', '=', $this->stateId)->get();
        }
    }
}
