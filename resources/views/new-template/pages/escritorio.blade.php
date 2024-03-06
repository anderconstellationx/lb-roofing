@extends('new-template.layouts.base')
@section('title', __('lang.dashboard'))
@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{ __('lang.user.welcome_dashboard', ['name' => auth()->user()->getCompleteName()]) }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.dashboard') }}</li>
            </ol>
        </div>
        <div class="d-flex">
            <div class="justify-content-center">
                <button hidden class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-status-project"
                        onclick="openEstadoProyecto()">
                    <i class="fa-solid fa-toolbox"></i> {{ __('lang.status') }}
                </button>
            </div>
        </div>
    </div>

    @if(auth()->user()->isAdmin())
        <div class="mg-b-20">
            <div class="row row-sm">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="card-order ">
                                <label class="main-content-label mb-3 pt-1">{{ __('lang.clients') }}</label>
                                <h2 class="text-end card-item-icon card-icon">
                                    <i class="mdi mdi-account-multiple icon-size float-start text-primary"></i><span class="font-weight-bold">{{ \App\Models\Usuario::getUserCountByRole(\App\Models\Usuario::CLIENT) }}</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="card-order">
                                <label class="main-content-label mb-3 pt-1">{{ __('lang.project.projects') }}</label>
                                <h2 class="text-end"><i class="mdi mdi-cube icon-size float-start text-primary"></i><span class="font-weight-bold">{{ \App\Models\Proyecto::all()->count() }}</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div>
        <div class="card">
            <div class="card-body">
                @livewire('kanban-board')
            </div>
        </div>
    </div>

    <!-- Modal para crear estados de proyectos -->
    <div class="modal fade" id="modal-status-project" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close dark-mode" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <livewire:forms-estado-proyecto/>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/Sortable.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-sortable.min.js') }}"></script>
    <script>
        const modalStatus = $("#modal-status-project")

        function openEstadoProyecto(statusId = 0) {
            const statusModel = modalStatus
            statusModel.find('.modal-title').text('{{ __('lang.status_project_create') }}');
            if (statusId) {
                statusModel.find('.modal-title').text('{{ __('lang.status_project_update') }}');
                Livewire.dispatch('update-status-project', {statusId: statusId})
            }
            statusModel.modal('show');
        }
    </script>
    <script>
        $(function () {
            $('#kanban .list-group').sortable({
                group: 'list',
                animation: 200,
                ghostClass: 'ghost',
                handle: '.handle',
                sort: false,
                //multiDrag: true, // Enable multi-drag
                selectedClass: 'kanban-selected', // The class applied to the selected items
                fallbackTolerance: 3, // So that we can select items on mobile
                store: {
                    /**
                     * Save the order of elements. Called onEnd (when the item is dropped).
                     * @param {Sortable}  sortable
                     */
                    set: function (sortable) {
                        Livewire.dispatch('update-kanban', {
                            projects: sortable.toArray(),
                            statusId: $(sortable.el).data('status')
                        })
                    }
                },
            });
        })
    </script>
@endpush

