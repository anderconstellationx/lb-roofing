<?php

namespace App\Livewire;

use App\Models\Cotizacion;
use App\Models\CotizacionItem;
use App\Models\EstadoFactura;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Proyecto;
use App\Models\Usuario;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;
use Illuminate\Support\Facades\View;


class FacturaDone extends Component
{
    // set invoice id by url
    public $invoiceId;
    public $projectId;
    public $invoice = [];
    public $proyecto = [];
    public $cotizacion = [];
    public $itemsCotizacion = [];
    public $productos = [];
    public $cliente;
    public $encargado;
    public $infoEstado;


    public function mount($project_id = null, $invoice_id)
    {
        $this->invoiceId = $invoice_id;
        $this->projectId = $project_id;
        $this->invoice = Factura::find($invoice_id);
        $this->proyecto = Proyecto::find($project_id);
        $this->cliente = Usuario::find($this->proyecto->usuario_cliente_id);
        $this->encargado = Usuario::find($this->proyecto->usuario_encargado_id);
        $this->cotizacion = Cotizacion::where('proyecto_id', $project_id)->first();
        $this->invoice->fecha_emision = date('Y-m-d', strtotime($this->invoice->fecha_emision));
        $this->invoice->fecha_vencimiento = date('Y-m-d', strtotime($this->invoice->fecha_vencimiento));
        $this->itemsCotizacion = CotizacionItem::where('cotizacion_id', $this->cotizacion->id)->get();
        foreach ($this->itemsCotizacion as $item) {
            $this->productos[] = Producto::find($item->producto_id);
        }
        $this->infoEstado = $this->generateMessageInfo($this->invoice->estado_factura_id);
    }

    public function showInvoice($uuid)
    {
        $uui = Factura::where('uuid', $uuid)->first();
        if (!$uui) {
            abort(404);
        }

        $this->invoice = Factura::find($uui->id);
        $this->proyecto = Proyecto::find($this->invoice->proyecto_id);
        $this->cotizacion = Cotizacion::find($this->invoice->cotizacion_id);
        $this->itemsCotizacion = CotizacionItem::where('cotizacion_id', $this->cotizacion->id)->get();
        $this->cliente = Usuario::find($this->proyecto->usuario_cliente_id);
        $this->encargado = Usuario::find($this->proyecto->usuario_encargado_id);
        foreach ($this->itemsCotizacion as $item) {
            $this->productos[] = Producto::find($item->producto_id);
        }
        View::share('showHeader', false);
        View::share('showSidebar', false);
        return view("livewire.project.show-invoice", [
            'invoice' => $uui,
            'proyecto' => $this->proyecto,
            'cotizacion' => $this->cotizacion,
            'itemsCotizacion' => $this->itemsCotizacion,
            'productos' => $this->productos,
            'cliente' => $this->cliente,
            'infoEstado' => $this->generateMessageInfo($this->invoice->estado_factura_id),
        ]);
    }

    public function render()
    {
        return view('livewire.factura-done');
    }

    public static function generateLinkShare($invoiceId): string
    {
        $invoice = Factura::find($invoiceId)->first();
        return route('show-invoice', ['uuid' => $invoice->uuid]);
    }

    public function generateMessageInfo($status): string
    {
        switch ($status) {
            case EstadoFactura::DRAFT:
                $this->infoEstado = '<div id="estadoFactura" class="badge bg-pill bg-warning-light">Draft</div>';
                break;
            case EstadoFactura::DUE:
                $this->infoEstado = '<div id="estadoFactura" class="badge bg-pill bg-danger-light">Due</div>';
                break;
            case EstadoFactura::PAID:
                $this->infoEstado = '<div id="estadoFactura" class="badge bg-pill bg-primary-light">Paid</div>';
                break;
        }
        $this->dispatch('updateInfoEstado', $this->infoEstado);
        return $this->infoEstado;
    }

}
