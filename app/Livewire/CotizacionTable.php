<?php

namespace App\Livewire;

use App\Models\Proyecto;
use Illuminate\Support\Facades\Route;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Cotizacion;
use Illuminate\Database\Eloquent\Builder;

class CotizacionTable extends DataTableComponent
{
    protected $model = Cotizacion::class;
    const ALL_QUOTE = 'all-quotes';

    public int $id;

    public function mount($id): void
    {
        $this->id = $id;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->searchStatus = false;
        $this->paginationStatus = false;
        $this->emptyMessage = __('lang.empty');
        $this->columnSelectStatus = false;
        $this->setAdditionalSelects(['cotizacion.proyecto_id', 'cotizacion.id']);
    }

    public function columns(): array
    {
        $baseColumns = [
            Column::make(__('lang.name'), "name")->sortable(),
            Column::make(__('lang.total'), "total")->format(
                function ($value, $row) {
                    return '$ ' . number_format($value, 2);
                }
            )->sortable(),
            Column::make(__('lang.status'), "estado_cotizacion.nombre")->sortable(),
        ];

        if (Route::currentRouteName() == self::ALL_QUOTE) {
            $additionalColumns = [
                Column::make(__('lang.project.project'), "proyecto.titulo")->sortable()->searchable(),
                Column::make(__('lang.DateOfIssue'), "fecha_emision")->sortable()->searchable(),
                Column::make(__('lang.DateOfExpiry'), "fecha_vencimiento")->sortable()->searchable(),
                Column::make(__('lang.added_by'), "usuario.nombres")->sortable()->searchable(),
            ];
            $baseColumns = array_merge($baseColumns, $additionalColumns);
        }
        $baseColumns[] = Column::make(__('lang.actions'), 'id')->format(
            function ($value, $row, Column $column) {
                $quoteId = (int)$row->id;
                $projectId = (int)$row->proyecto_id;
                return $this->makeButtonShowQuoteDetail($projectId, $quoteId);
            }
        )->html();
        return $baseColumns;
    }


    private function makeButtonShowQuoteDetail($projectId, $quoteId)
    {
        return sprintf("<a class='btn btn-primary'  href='%s'><i class='fa-solid fa-eye'></i></a>", route('view-project-quote', ['id' => $projectId, 'quote_id' => $quoteId]));
    }

    public function builder(): Builder
    {
        if (auth()->user()->isClient()) {
            return Cotizacion::query()->whereIn('proyecto_id', function ($query) {
                $query->select('id')
                    ->from('proyecto')
                    ->where('usuario_cliente_id', auth()->user()->id);
            });
        }

        if (Route::currentRouteName() == self::ALL_QUOTE) {
            return Cotizacion::query();
        }
        return Cotizacion::query()
            ->where(
                [
                    'proyecto_id' => $this->id
                ]
            );
    }
}
