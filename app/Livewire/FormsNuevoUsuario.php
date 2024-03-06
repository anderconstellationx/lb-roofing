<?php

namespace App\Livewire;

use App\Models\Usuario;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Helpers\GlobalMessage;

class FormsNuevoUsuario extends Component
{
    use GlobalMessage;
    public $id;
    public $nombres;
    public $apellidos;
    public $email;
    public $password;
    public $nacimiento;
    public $documento;
    public $genero;
    public $fecha_creacion;
    public $fecha_modificacion;
    public $rol;
    public $estado;
    public $direccion;
    public $telefono;
    public $user;

    protected $listeners = [
        'edit-user' => 'editUser',
        'add-user' => 'addUser',
        'delete-user' => 'deleteUser',
    ];

    public $textActionForm;

    public function mount()
    {
        $this->textActionForm = __('lang.user.create_user');
        $this->setTileForm();
    }

    public function render()
    {
        return view('livewire.forms-nuevo-usuario');
    }

    public function rules()
    {
        return [
            'nombres' => 'required',
            'apellidos' => 'required',
            'email' => 'required',
            'password' => !$this->user ? 'required' : '',
            'rol' => 'required',
            'estado' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'nombres.required' => __('lang.this_field_is_required'),
            'apellidos.required' => __('lang.this_field_is_required'),
            'email.required' => __('lang.this_field_is_required'),
            'password.required' => __('lang.this_field_is_required'),
            'rol.required' => __('lang.this_field_is_required'),
            'estado.required' => __('lang.this_field_is_required'),
        ];
    }

    public function guardar()
    {
        $this->validate();

        if ($this->user) {
            // update user
            $user = $this->user;
        } else {
            // create user
            $user = new Usuario();
        }

        $user->nombres = $this->nombres;
        $user->apellidos = $this->apellidos;
        $user->email = $this->email;
        if ($this->password) {
            $user->password = Hash::make($this->password);
        }
        $user->nacimiento = $this->nacimiento;
        $user->documento = $this->documento;
        $user->genero = $this->genero ?? 1;
        $user->fecha_creacion = now();
        $user->fecha_modificacion = now();
        $user->rol_id = $this->rol;
        $user->estado_id = $this->estado;
        $user->telefono = $this->telefono;
        $user->direccion = $this->direccion;
        $save = $user->save();
        if ($save) {
            $this->dispatch('refreshDatatable');
            $this->reset(['nombres', 'apellidos', 'email', 'password', 'nacimiento', 'documento', 'genero', 'rol', 'estado']);
            $this->globalDispatchModal('modal-create-user');
            $this->globalDispatchSweetAlert();
        }
    }

    public function addUser()
    {
        $this->textActionForm = __('lang.user.create_user');
        $this->dispatch('text-action-user', text: $this->textActionForm);
    }

    public function editUser($id)
    {
        $this->textActionForm = __('lang.user.update_user');
        $this->setTileForm();
        $user = Usuario::findOrFail($id);
        if ($user) {
            $this->user = $user;
            $this->id = $user->id;
            $this->nombres = $user->nombres;
            $this->apellidos = $user->apellidos;
            $this->email = $user->email;
            $this->nacimiento = date('Y-m-d', strtotime($user->nacimiento));
            $this->documento = $user->documento;
            $this->genero = $user->genero;
            $this->fecha_creacion = $user->fecha_creacion;
            $this->fecha_modificacion = $user->fecha_modificacion;
            $this->rol = $user->rol_id;
            $this->estado = $user->estado_id;
            $this->telefono = $user->telefono;
            $this->direccion = $user->direccion;
        }
    }

    private function setTileForm()
    {
        $this->dispatch('text-action-user', text: $this->textActionForm);
    }

    public function deleteUser($id)
    {
        try {
            $user = Usuario::findOrFail($id);
            $user->delete();
            $this->dispatch('refreshDatatable');
            $this->globalDispatchSweetAlert();
        } catch (\Exception $e) {
            error_log('Delete user ' . $e->getMessage());
            $this->globalDispatchSweetAlert(icon:'error');

        }
    }

}
