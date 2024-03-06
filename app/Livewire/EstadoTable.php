<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Estado;

class EstadoTable extends DataTableComponent
{
    protected $model = Estado::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');$this->searchStatus = false;
        $this->paginationStatus = false;
        $this->emptyMessage = __('lang.empty');
        $this->columnSelectStatus = false;
        $this->setAdditionalSelects(['estado.id']);
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
        ];
    }
}
