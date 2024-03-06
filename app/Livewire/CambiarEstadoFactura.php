<?php

namespace App\Livewire;

use App\Helpers\GlobalMessage;
use App\Mail\InvoiceNotifyAdmins;
use App\Mail\InvoiceNotifyUser;
use App\Mail\QuoteNotifyClient;
use App\Models\Estado;
use App\Models\EstadoFactura;
use App\Models\Rol;
use App\Models\Usuario;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Models\Factura;

class CambiarEstadoFactura extends Component
{
    use GlobalMessage;
    public $invoiceId;
    public $estados = [];
    public $estado;
    protected $listeners = [
        'actualizar-estado' => 'updateStatus'
    ];

    public function render()
    {
        $this->estados = EstadoFactura::all();
        return view('livewire.cambiar-estado-factura');
    }

    public function mount($invoice_id)
    {
        $this->invoiceId = $invoice_id;
        $this->estado = Factura::find($this->invoiceId)->estado_factura_id;
    }

    public function updateStatus($estado)
    {
        $this->estado = $estado;
        $factura = Factura::find($this->invoiceId);
        $update = $factura->update(['estado_factura_id' => $this->estado]);
        if ($update) {
            if ($this->estado == EstadoFactura::PAID) {
                Mail::to($factura->proyecto->usuario_cliente->email)->send(new InvoiceNotifyUser($factura));
                foreach (Usuario::where('rol_id', Rol::ADMINISTRATOR)->get() as $admin) {
                    Mail::to($admin->email)->send(new InvoiceNotifyAdmins($factura, $admin));
                }
            }
            $this->globalDispatchSweetAlert();
            return redirect()->route('view-project-invoice', ['id' => $factura->proyecto_id, 'invoice_id' => $factura->id]);
        }
    }

}
