<?php

namespace App\Livewire;

use App\Helpers\GlobalMessage;
use App\Models\Cotizacion;
use App\Models\EstadoFactura as Estados;
use App\Models\Factura;
use App\Models\Proyecto;
use App\Models\Usuario;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;
use Termwind\Components\Dd;


class FormsNuevaFactura extends Component
{
    use GlobalMessage;
    // id for GET request
    public $id, $invoiceId;
    public $estadosFactura = [];
    public $cotizaciones = [];
    public $proyectos = [];
    public $titulo;
    public $codigoFactura;
    public $fechaEmision;
    public $fechaVencimiento;
    public $subtotal = 0;
    public $descuento = 0;
    public $total = 0;
    public $observaciones;
    public $fechaCreacion;
    public $fechaModificacion;
    public $creadoPor;
    public $cliente;
    public $proyecto;
    public $cotizacion;
    public $estadoFactura;


    public function render()
    {
        return view('livewire.forms-nueva-factura');
    }

    public function mount($id, $invoice_id)
    {
        $this->invoiceId = $invoice_id;
        if($invoice_id) {
            $factura = Factura::find($invoice_id);
            $this->titulo = $factura->titulo;
            $this->fechaEmision = $factura->fecha_emision;
            $this->fechaVencimiento = $factura->fecha_vencimiento;
            $this->subtotal = $factura->subtotal;
            $this->descuento = $factura->descuento;
            $this->total = $factura->total;
            $this->observaciones = $factura->observaciones;
            $this->fechaCreacion = $factura->fecha_creacion;
            $this->fechaModificacion = $factura->fecha_modificacion;
            $this->creadoPor = $factura->usuario_id;
            $this->cotizacion = $factura->cotizacion_id;
            $this->estadoFactura = $factura->estado_factura_id;
        }

        $factura = new Factura();
        $cotizacion = Cotizacion::all()->where('proyecto_id', $this->id);
        $this->fechaEmision = date('Y-m-d');
        $this->fechaVencimiento = date('Y-m-d', strtotime($this->fechaEmision . '+ 31 days'));
        $this->estadosFactura = Estados::all();
        $this->codigoFactura = $factura->generarCodigoFactura();
        $this->cotizaciones = $cotizacion;
        $this->proyecto = Proyecto::find($this->id);
        $this->cliente = Usuario::find($this->proyecto->usuario_cliente_id);

    }

    public function filtrarCotizacion()
    {
        $this->subtotal = 0;
        $this->descuento = 0;
        $this->total = 0;
        if ($this->cotizacion) {
            $cotizacion = Cotizacion::where('id', $this->cotizacion)->first();
            $this->subtotal = $cotizacion->subtotal;
            $this->descuento = $cotizacion->descuento;
            $this->total = $cotizacion->total;
        }
    }

    public function crearFactura()
    {
        $factura = new Factura();
        $factura->titulo = $this->titulo;
        $factura->codigo_factura = $this->codigoFactura;
        $factura->fecha_emision = date('Y-m-d', strtotime($this->fechaEmision));
        $factura->fecha_vencimiento = date('Y-m-d', strtotime($this->fechaVencimiento));
        $factura->subtotal = $this->subtotal;
        $factura->descuento = $this->descuento;
        $factura->total = $this->total;
        $factura->observaciones = $this->observaciones;
        $factura->fecha_creacion = now();
        $factura->fecha_modificacion = now();
        $factura->proyecto_id = $this->id;
        $factura->cotizacion_id = $this->cotizacion;
        $factura->usuario_id = auth()->user()->id;
        $factura->usuario_cliente_id = $this->cliente->id;
        $factura->estado_factura_id = $this->estadoFactura ?? 1;
        if ($factura->save()) {
            $this->globalDispatchSweetAlert(action: 'session');
            return redirect()->route('view-project-invoice', ['id' => $this->id, 'invoice_id' => $factura->id]);
        }
    }
}
