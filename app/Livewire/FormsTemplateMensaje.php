<?php

namespace App\Livewire;

use App\Helpers\GlobalMessage;
use App\Models\TemplateMessage;
use Livewire\Component;

class FormsTemplateMensaje extends Component
{
    use GlobalMessage;
    public $id;
    public $name;
    public $content;


    public function render()
    {
        return view('livewire.forms-template-mensaje');
    }

    public function mount($id)
    {
        if ($id) {
            $this->id = $id;
            $template = TemplateMessage::find($this->id);
            $this->name = $template->name;
            $this->content = $template->message;
        }
    }

    public function createTemplateMessage()
    {
        $this->validate([
            'name' => 'required',
            'content' => 'required'
        ]);

        if ($this->id) {
            $template = TemplateMessage::find($this->id);
        } else {
            $template = new TemplateMessage();
        }
        $template->name = $this->name;
        $template->message = $this->content;
        if (!$this->id) $template->fecha_creacion = date('Y-m-d');
        $template->fecha_modificacion = date('Y-m-d');
        if ($template->save()) {
            $this->dispatch('refreshDatatable');
            if (!$this->id) {
                $this->reset(['name', 'content']);
            }
            $this->globalDispatchSweetAlert();
            $this->redirect('/template-message');
        }
    }

}
