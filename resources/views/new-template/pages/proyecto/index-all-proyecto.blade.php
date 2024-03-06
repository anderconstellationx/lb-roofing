@extends('new-template.layouts.base')
@section('title', __('lang.allProjects'))
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{ __('lang.allProjects') }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("dashboard")}}">{{__('lang.home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.allProjects')  }}</li>
            </ol>
        </div>
        <div class="d-flex">
            <div class="justify-content-center">
                @if(\App\Models\Usuario::accessAllowed())
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create-project">
                        <i class="ti-write"></i> {{ __('lang.project.addProject') }}
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-status-project"
                            onclick="openEstadoProyecto()">
                        <i class="fa-solid fa-toolbox"></i> {{ __('lang.status') }}
                    </button>
                    <a class="btn btn-primary" href="{{ route('dashboard') }}">
                        <i class="fa fa-clone"></i>
                        {{ __('lang.goToKanban') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="card mg-t-20">
        <div class="card-body">
            @livewire('proyecto-table')
        </div>
    </div>
@endsection
@push('modals')
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
    {{--    Modal para crear clientes--}}
    <div class="modal fade" id="NuevoCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close dark-mode" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <livewire:forms-nuevo-usuario/>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal create project -->
    <div class="modal fade" id="modal-create-project" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ __('lang.createProject') }}</h5>
                    <button type="button" class="btn-close dark-mode" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <livewire:forms-nuevo-proyecto/>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('script')
    <script>
        const modalStatus = $("#modal-status-project")
        const modalClient = $("#NuevoCliente")
        function openEstadoProyecto(statusId = 0) {
            const statusModel = modalStatus
            statusModel.find('.modal-title').text('{{ __('lang.status_project_create') }}');
            if (statusId) {
                statusModel.find('.modal-title').text('{{ __('lang.status_project_update') }}');
                Livewire.dispatch('update-status-project', {statusId: statusId})
            }
            statusModel.modal('show');
        }

        function newClient() {
            modalClient.modal('show');
        }

        window.addEventListener('response-alert', event => {
            modalClient.modal('hide')
            Livewire.dispatch('actualizarClientes');
        })

    </script>
@endpush
