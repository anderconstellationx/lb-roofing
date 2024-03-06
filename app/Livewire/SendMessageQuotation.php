<?php

namespace App\Livewire;

use App\Mail\QuoteNotifyClient;
use App\Models\ClienteEstadoCotizacion;
use App\Models\Cotizacion;
use App\Models\EstadoCotizacion;
use App\Models\Proyecto;
use App\Models\ProyectoEstado;
use App\Models\TemplateMessage;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Unique;
use Livewire\Component;

class SendMessageQuotation extends Component
{
    public $quote_id;
    public $title, $message;
    public $selectTemplate;
    public $templates = [];

    public function render()
    {

        return view('livewire.send-message-quotation');
    }

    public function selectTemplateUpdate()
    {
       if($this->selectTemplate){
           $template = TemplateMessage::find($this->selectTemplate);
           $this->title = $template->name;
           $this->message = $template->message;
           $this->dispatch('update-summernote', message: $this->message);
       }
    }

    public function mount()
    {
        $this->templates = TemplateMessage::all();
    }

    public function sendMessageQuoting()
    {
        $this->validate([
            'title' => 'required',
            'message' => 'required',
        ]);
         try {
            $quote = Cotizacion::findOrFail($this->quote_id);

            // update status quote
            $quote->estado_cotizacion_id = EstadoCotizacion::SENT;
            $quote->save();
            // update project status sent
            $project = Proyecto::findOrFail($quote->proyecto_id);

            $project->proyecto_estado_id = ProyectoEstado::SENT;
            $project->save();
            $quote->load('proyecto', 'proyecto.usuario_cliente');
            $clientStatusQuote = ClienteEstadoCotizacion::create([
                'cotizacion_id' => $quote->id,
                'titulo' => $this->title,
                'mensaje_cliente' => $this->message,
            ]);
            Mail::to($quote->proyecto->usuario_cliente->email)->send(new QuoteNotifyClient($quote, $clientStatusQuote));
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->route('view-project', ['id' => $quote->proyecto_id]);
    }


}
