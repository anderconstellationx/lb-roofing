<?php

namespace App\Livewire;

use App\Helpers\Money;
use App\Models\Usuario;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TemplateCotizacion;

class TemplateCotizacionTable extends DataTableComponent
{
    protected $model = TemplateCotizacion::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['template_cotizacion.id']);
    }

    public function columns(): array
    {
        return [
            Column::make(__('lang.name'), "name")
                ->sortable(),
            Column::make(__('lang.sub_total'), "subtotal")->format(
                function ($value, $row, Column $column) {
                    return Money::format($value);
                }
            )->sortable(),
            Column::make(__('lang.discount'), "descuento")->format(
                function ($value, $row, Column $column) {
                    return Money::format($value);
                }
            )->sortable(),
            Column::make(__('lang.tax'), "tax")->format(
                function ($value, $row, Column $column) {
                    return Money::format($value);
                }
            )->sortable(),
            Column::make(__('lang.total'), "total")->format(
                function ($value, $row, Column $column) {
                    return Money::format($value);
                }
            )->sortable(),
            Column::make(__('lang.observations'), "observaciones")
                ->sortable(),
            Column::make(__('lang.created_at'), "fecha_creacion")
                ->sortable(),
            Column::make(__('lang.update_at'), "fecha_modificacion")
                ->sortable(),
            Column::make(__('lang.added_by'), "usuario_id")
                ->format(
                    function ($value, $row, Column $column) {
                        return Usuario::find($value)->getCompleteName();
                    }
                )->sortable(),
            Column::make("", 'id')
                ->format(
                    function ($value, $row, Column $column) {
                        $rowId = (int)$row->id;
                        return $this->makeButtonEdit($rowId);
                    }
                )->html()
        ];
    }

    private function makeButtonEdit($id): string
    {
        return "<a class='btn btn-primary' href='". route('quote-template', ['quote_template_id' => $id]) ."'><i class='fa-solid fa-pen'></i></a>";
    }

}
