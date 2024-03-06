<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Factura;

class FacturaTable extends DataTableComponent
{
    protected $model = Factura::class;
    public int $id;
    const ALL_INVOICE = 'all-invoices';


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
        $this->setAdditionalSelects(['factura.id', 'factura.proyecto_id']);
    }

    public function columns(): array
    {
        $baseColumns = [
            Column::make(__('lang.title'), "titulo")
                ->sortable(),
            Column::make(__('lang.status'), "estado_factura.nombre")
                ->sortable(),
            Column::make(__('lang.total'), "total")->format(
                function ($value, $row) {
                    return '$ ' . number_format($value, 2);
                }
            )->sortable(),
        ];
        if (Route::currentRouteName() == self::ALL_INVOICE) {
            $additionalColumns = [
                Column::make(__('lang.project.project'), "proyecto.titulo")->sortable()->searchable(),
                Column::make(__('lang.client'), "usuario_cliente.nombres")->sortable()->searchable(),
                Column::make(__('lang.DateOfIssue'), "fecha_emision")->sortable()->searchable(),
                Column::make(__('lang.DateOfExpiry'), "fecha_vencimiento")->sortable()->searchable(),
                Column::make(__('lang.added_by'), "usuario.nombres")->sortable()->searchable(),
            ];
            $baseColumns = array_merge($baseColumns, $additionalColumns);
        }
        $baseColumns[] = Column::make(__('lang.actions'), 'id')->format(
            function ($value, $row, Column $column) {
                $invoiceId = (int)$row->id;
                $projectId = (int)$row->proyecto_id;
                return $this->makeButtonShowInvoiceDetail($projectId, $invoiceId);
            }
        )->html();

        return $baseColumns;
    }

    private function makeButtonShowInvoiceDetail($projectId, $invoiceId)
    {
        $invoiceId = empty($invoiceId) ? 0 : $invoiceId;
        return sprintf("<a class='btn btn-primary'  href='%s'><i class='fa-solid fa-eye'></i></a>", route('view-project-invoice', ['id' => $projectId, 'invoice_id' => $invoiceId]));
    }

    public function builder(): Builder
    {
        if (auth()->user()->isClient()) {
            return Factura::query()->where([
                'factura.usuario_cliente_id' => auth()->user()->id,
            ]);
        }
        if (Route::currentRouteName() == self::ALL_INVOICE) {
            return Factura::query();
        }
        return Factura::query()
            ->where(
                [
                    'proyecto_id' => $this->id
                ]
            );
    }
}
