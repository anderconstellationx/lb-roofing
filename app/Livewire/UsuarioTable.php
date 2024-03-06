<?php

namespace App\Livewire;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Usuario;

class UsuarioTable extends DataTableComponent
{
    public string $currentRoute;
    protected $model = Usuario::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['usuario.id']);
    }

    public function builder(): Builder
    {
        Debugbar::info($this->currentRoute);
        return match ($this->currentRoute) {
            'sellers' => Usuario::query()->where('rol_id', Usuario::EMPLOYEE),
            'accountants' => Usuario::query()->where('rol_id', Usuario::ACCOUNTANT),
            'administrators' => Usuario::query()->where('rol_id', Usuario::ADMIN),
            'clients' => Usuario::query()->where('rol_id', Usuario::CLIENT)
        };
    }

    public function mount()
    {
        $this->currentRoute = Route::currentRouteName();
    }


    public function columns(): array
    {
        return [
            Column::make(__('lang.name'), "nombres")
                ->sortable(),
            Column::make(__('lang.lastName'), "apellidos")
                ->sortable(),
            Column::make(__('lang.email'), "email")
                ->sortable(),
            Column::make(__('lang.birthDate'), "nacimiento")->format(
                function ($value, $row, Column $column) {
                    return date('Y-m-d', strtotime($value));
                }
            )->sortable(),
            Column::make(__('lang.document'), "documento")
                ->sortable(),
            Column::make(__('gender'), "genero")->format(
                function ($value, $row, Column $column) {
                    return Usuario::GENDER[(int)$value] ? __(Usuario::GENDER[(int)$value]) : '';
                }
            )->sortable(),
            Column::make(__('lang.created_at'), "fecha_creacion")
                ->sortable(),
            Column::make(__('lang.update_at'), "fecha_modificacion")
                ->sortable(),
            Column::make(__('lang.role'), "rol.nombre")
                ->sortable(),
            Column::make(__('lang.status'), "estado.nombre")
                ->sortable(),
            Column::make(__('lang.actions'), 'id')
                ->format(
                    function ($value, $row, Column $column) {
                        $userId = auth()->user()->id;
                        $rowId = (int)$row->id;
                        return $this->makeButtonEdit($rowId) . ' ' . ($userId !== $rowId ? $this->makeButtonDelete($rowId) : '');
                    }
                )->html()
        ];
    }

    private function makeButtonEdit($id)
    {
        return "<button type='button' class='btn btn-primary' data-user='".$id."' data-bs-toggle='modal' data-bs-target='#modal-create-user'><i class='fa-solid fa-pen'></i></button>";
    }

    private function makeButtonDelete($id)
    {
        return '';
        //return "<button type='button' class='btn btn-primary' onclick='deleteUser($id);'><i class='fa-solid fa-trash'></i></button>";
    }
}
