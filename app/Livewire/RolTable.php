<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Rol;

class RolTable extends DataTableComponent
{
    protected $model = Rol::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['rol.id']);
    }

    public function columns(): array
    {
        return [
            Column::make(__('lang.name'), "nombre")
                ->sortable(),
            Column::make(__('lang.slug'), "slug")
                ->sortable(),
            Column::make(__('lang.description'), "descripcion")
                ->sortable(),
            Column::make(__('lang.created_at'), "fecha_creacion")
                ->sortable(),
        ];
    }
}
