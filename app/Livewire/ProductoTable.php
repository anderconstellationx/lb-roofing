<?php

namespace App\Livewire;

use App\Models\TipoMedida;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Producto;

class ProductoTable extends DataTableComponent
{
    protected $model = Producto::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['producto.id']);
    }

    public function columns(): array
    {
        return [
            Column::make(__('lang.name'), "nombre")
                ->sortable()
                ->searchable(),
            Column::make(__(__('lang.provider')), "proveedor.nombre")
                ->sortable()->searchable(),
            Column::make(__(__('lang.unit_measurement')), "unidad_medida")
                ->sortable()
                ->format(fn($value, $row, Column $column) => $row->unidad_medida)
                ->html(),
            Column::make(__('lang.price_buy'), "precio_compra")
                ->sortable()->format(fn($value, $row, Column $column) => '$ ' . $row->precio_compra . '.00')->html(),
            Column::make(__('lang.price_sale'), "precio_venta")
                ->sortable()->format(fn($value, $row, Column $column) => '$ ' . $row->precio_venta . '.00')->html(),
            Column::make(__('lang.added_by'), "usuario.email")
                ->sortable()->searchable(),
            Column::make(__('lang.created_at'), "fecha_creacion")
                ->sortable(),
            Column::make(__('lang.update_at'), "fecha_modificacion")
                ->sortable(),
        ];
    }
}
