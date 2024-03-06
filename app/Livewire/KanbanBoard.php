<?php

namespace App\Livewire;

use App\Models\Proyecto;
use App\Models\ProyectoEstado;
use Livewire\Component;
use Livewire\Attributes\On;
class KanbanBoard extends Component
{
    protected $listeners = [
        'update-kanban' => 'updateStatusProject',
    ];

    public $projects = [];

    public function mount()
    {
        $this->setProjectToKanban();
    }

    public function render()
    {
        return view('livewire.kanban-board');
    }

    public function updateStatusProject($projects, $statusId)
    {
        if ($projects) {
            foreach ($projects as $projectId) {
                $project = Proyecto::find($projectId);
                if ($project) {
                    $project->proyecto_estado_id = $statusId;
                    $project->save();
                }
            }
            $this->setProjectToKanban();
        }
    }

    #[On('project-created')]
    public function updateKanbanList($id, $title, $status)
    {
        $this->projects[$status]['projects'][] = [
            'id' => $id,
            'name' => $title,
        ];
    }

    #[On('status-project-created')]
    public function updateStatusKanbanList()
    {
        $this->setProjectToKanban();
    }

    private function setProjectToKanban()
    {
        $projects = Proyecto::with('proyecto_estado')->orderBy('fecha_creacion', 'desc')->get();
        $statusProject = ProyectoEstado::all();
        $this->projects = [];
        if ($statusProject) {
            foreach ($statusProject as $status) {
                $statusIdProject = $status->id;
                $this->projects[$statusIdProject] = [
                    'id' => $statusIdProject,
                    'name' => $status->nombre,
                    'description' => $status->descripcion,
                    'color' => $status->color,
                    'projects' => [],
                ];
            }

            if ($projects) {
                foreach ($projects as $project) {
                    $idProject = $project->id;
                    $nameProject = $project->titulo;
                    $statusIdProject = $project->proyecto_estado->id;
                    $statusNameProject = $project->proyecto_estado->nombre;

                    if (!isset($this->projects[$statusIdProject])) {
                        $this->projects[$statusIdProject] = [
                            'id' => $statusIdProject,
                            'name' => $statusNameProject,
                            'projects' => [],
                        ];
                    }

                    if ($statusIdProject == ProyectoEstado::FINISHED && count($this->projects[$statusIdProject]['projects']) > 9) {
                        continue;
                    }

                    $this->projects[$statusIdProject]['projects'][] = [
                        'id' => $idProject,
                        'name' => $nameProject,
                    ];
                }
            }
        }
    }
}
