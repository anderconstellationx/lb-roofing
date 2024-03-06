<?php

namespace App\Livewire;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Proyecto;

class ProyectoTable extends DataTableComponent
{
    protected $model = Proyecto::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['proyecto.id']);
    }

    public function builder() : Builder
    {
        if (auth()->user()->isClient()) {
            return Proyecto::query()->where('proyecto.usuario_cliente_id', auth()->user()->id);
        }
        return Proyecto::query();
    }

    public function columns(): array
    {
        return [
            Column::make(__('lang.title'), "titulo")
                ->sortable()->searchable(),
            Column::make(__('lang.startDate'), "fecha_inicio")
                ->sortable()->searchable(),
            Column::make(__('lang.endDate'), "fecha_fin")
                ->sortable()->searchable(),
            Column::make(__('lang.creationDate'), "fecha_creacion")
                ->sortable()->searchable(),
            Column::make(__('lang.modificationDate'), "fecha_modificacion")
                ->sortable()->searchable(),
            Column::make(__('lang.direction'), "direccion")
                ->sortable()->searchable(),
            Column::make(__('lang.observations'), "observaciones")
                ->sortable()->searchable(),
            Column::make(__('lang.responsible'), "usuario_encargado.nombres")
                ->sortable()->searchable(),
            Column::make(__('lang.projectStatus'), "proyecto_estado.nombre")
                ->sortable()->searchable(),
            Column::make(__('lang.added_by'), "usuario.nombres")
                ->sortable()->searchable(),
            Column::make(__('lang.client'), "usuario_cliente.nombres")
                ->sortable()->searchable(),
            Column::make(__('lang.actions'), "id")
                ->format(
                    function ($row) {
                        $projectId = (int) $row;
                        return $this->makeButtonView($projectId);
                    }
                )->html()
        ];
    }

    private function makeButtonView(int $projectId)
    {
        return sprintf("<a class='btn btn-primary'  href='%s'><i class='fa-solid fa-eye'></i></a>", route('view-project', ['id' => $projectId]));
    }
}
