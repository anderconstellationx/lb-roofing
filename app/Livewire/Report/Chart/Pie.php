<?php

namespace App\Livewire\Report\Chart;

use App\Models\Proyecto;
use App\Models\ProyectoEstado;
use App\Models\Usuario;
use Livewire\Component;

class Pie extends Component
{
    protected $listeners = [
        'filter-seller-report' => 'filterSellerReport',
        'filter-pie-report' => 'projectPieDateFilter',
    ];
    public array $sellerDateFilter = [
        'start_date' => '',
        'end_date' => '',
    ],
    $projectPieDateFilter = [
        'start_date' => '',
        'end_date' => '',
    ];
    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.report.chart.pie', [
            'pieChartProjects' => $this->getPieChartProjects(),
            'userClientCount' => Usuario::getUserCountByRole(Usuario::CLIENT),
            'projectsCount' => Proyecto::all()->count(),
            'usersSellerChart' => $this->getChartUserSeller()
        ]);
    }

    public function projectPieDateFilter($startDate, $endDate)
    {
        $this->projectPieDateFilter = [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
        $this->getPieChartProjects();
    }

    private function getPieChartProjects(): object
    {
        if (!$this->projectPieDateFilter['start_date']) {
            // first day of month
            $this->projectPieDateFilter['start_date'] = now()->firstOfMonth()->format('Y-m-d');
        }

        if (!$this->projectPieDateFilter['end_date']) {
            // last day of month
            $this->projectPieDateFilter['end_date'] = now()->lastOfMonth()->format('Y-m-d');
        }

        $countProjects = Proyecto::count();
        $pieChart = [];
        $showChart = false;
        foreach (ProyectoEstado::all() as $item) {
            $count = $item->proyectos()
                ->where('fecha_creacion', '>=', $this->projectPieDateFilter['start_date'])
                ->where('fecha_creacion', '<=', $this->projectPieDateFilter['end_date'])
                ->count();
            if($count) {
                $showChart = true;
            }
            $pieChart[] = [
                'label' => $item->nombre,
                'data' => $count ? round(($countProjects / $count) * 100, 2) : $count,
                'color' => $item->color
            ];
        }

        $this->dispatch('update-chart-pie-projects', data: $pieChart);

        return (object) [
            'data_chart' => $pieChart,
            'show_chart' => $showChart,
        ];
    }

    public function filterSellerReport($startDate, $endDate)
    {
        $this->sellerDateFilter = [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        $this->getChartUserSeller();
    }

    public function getChartUserSeller(): object
    {
        $chart = [];
        $showChart = false;
        if (!$this->sellerDateFilter['start_date']) {
            // first day of month
            $this->sellerDateFilter['start_date'] = now()->firstOfMonth()->format('Y-m-d');
        }

        if (!$this->sellerDateFilter['end_date']) {
            // last day of month
            $this->sellerDateFilter['end_date'] = now()->lastOfMonth()->format('Y-m-d');
        }

        $usersSeller = Usuario::whereIn('rol_id', [Usuario::EMPLOYEE, Usuario::ADMIN])->get();

        $completeNames = $usersSeller->map(function ($user) {
            return $user->getCompleteName();
        })->toArray();


        $chart['labels'] = $completeNames;

        $statusProjects = ProyectoEstado::whereIn('id', [ProyectoEstado::SENT, ProyectoEstado::IN_PROCESS])->get();
        foreach ($statusProjects as $status) {
            $projectCount = [];
            foreach ($usersSeller as $user) {
                $countProjects = Proyecto::where('fecha_creacion', '>=', $this->sellerDateFilter['start_date'])
                    ->where('fecha_creacion', '<=', $this->sellerDateFilter['end_date'])
                    ->where('proyecto_estado_id', '=', $status->id)
                    ->where('usuario_encargado_id', '=', $user->id)
                    ->count();
                if ($countProjects) {
                    $showChart = true;
                }
                $projectCount[] = $countProjects;
            }

            $chart['datasets'][] = [
                'label' => $status->nombre,
                'backgroundColor' => $status->color,
                'borderColor' => $status->color,
                'borderWidth' => 1,
                'data' => $projectCount,
            ];
        }

        $this->dispatch('update-chart-user-seller', data: $chart);

        return (object) [
            'data_chart' => $chart,
            'show_chart' => $showChart,
        ];
    }
}
