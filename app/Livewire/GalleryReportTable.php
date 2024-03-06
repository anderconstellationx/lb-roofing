<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\GalleryReport;

class GalleryReportTable extends DataTableComponent
{
    protected $model = GalleryReport::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['gallery_report.id', 'gallery_report.file']);
        $this->setDefaultSort('created_at', 'desc');

    }

    public function columns(): array
    {
        return [
            Column::make(__('lang.project.project'), "proyecto.titulo")
                ->sortable()->searchable(),
            Column::make(__('lang.title'), "title")
                ->sortable()->searchable(),
            Column::make(__('lang.user.user'), "usuario.nombres")
                ->sortable()->searchable(),
            Column::make(__('lang.created_at'), "created_at")
                ->sortable(),
            Column::make(__('lang.report'), "file")
                ->format(
                    function ($value, $row, Column $column) {
                        return '<a target="_blank" href="'. url($row->file) .'">
                                    <button type="button" class="btn btn-primary"><i
                                            class="fas fa-eye"></i> '.__('lang.show') .'</button>
                                </a>';
                    }
                )->html(),
        ];
    }
}
