<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TemplateMessage;

class TemplateMessageTable extends DataTableComponent
{
    protected $model = TemplateMessage::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Created at", "fecha_creacion")
                ->sortable(),
            Column::make("Updated at", "fecha_modificacion")
                ->sortable(),
            Column::make("Actions", "id")
                ->format(
                    function ($value, $row, Column $column) {
                        $rowId = (int)$row->id;
                        return $this->makeButtonEdit($rowId);
                    }
                )->html()
        ];
    }

    private function makeButtonEdit(int $rowId): string
    {
        return '<a class="btn btn-primary" href="' . route('template-message-view', ['id' => $rowId]) . '"><i class="fas fa-edit"></i></a>';
    }
}
