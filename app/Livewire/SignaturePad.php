<?php

namespace App\Livewire;

use App\Models\Factura;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;

class SignaturePad extends Component
{
    public $id;
    public $invoice_id;
    public $signature;

    protected $listeners = [
        'saveSignature' => 'signaturePadOnBegin',
    ];

    public function render()
    {

        return view('livewire.signature-pad');
    }

    public function signaturePadOnBegin($imageData)
    {
        $this->signature = $imageData;
        // actualiza el registro de la factura y le agrega la firma
        $invoice = Factura::find($this->invoice_id);
        $invoice->firma = $this->signature;
        $invoice->save();
        return redirect()->route('view-project-invoice', ['id' => $this->id, 'invoice_id' => $this->invoice_id]);
    }
}
