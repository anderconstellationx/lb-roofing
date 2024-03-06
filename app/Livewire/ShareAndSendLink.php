<?php

namespace App\Livewire;

use App\Helpers\GlobalMessage;
use App\Mail\ShareForEmail;
use App\Models\ClienteEstadoCotizacion;
use App\Models\Proyecto;
use App\Models\Usuario;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Livewire\Component;

class ShareAndSendLink extends Component
{
    use GlobalMessage;
    // project
    public int $id, $quoteId, $messageFor = 1;
    public string $link, $linkClient;

    // data Project
    public object $project;
    public object $receptor;
    public string $email;
    public string $subject;
    public string $message;

    public function mount($id, $link, $linkClient, $quote_id)
    {
        $this->id = $id;
        $this->link = $link;
        $this->quoteId = $quote_id;
        $this->linkClient = $linkClient;
    }
    public function render()
    {
        $this->project = Proyecto::find($this->id);
        $this->receptor = Usuario::find($this->project->usuario_cliente_id);
        $this->email = $this->receptor->email;
        $this->subject = __('lang.emails.subject_preview') . ' ' . $this->project->titulo;
        $this->message = __('lang.emails.message_preview');
        return view('livewire.share-and-send-link');
    }


    public function sendEmail()
    {
        $linkSend = $this->link;
        if ($this->messageFor == 2) {
            $linkSend = $this->linkClient;
        }

        Mail::to($this->email)->send(new ShareForEmail($linkSend, $this->receptor, $this->subject, $this->message));
        $this->globalDispatchModal('shareModal');
        $this->globalDispatchSweetAlert();
    }
}

