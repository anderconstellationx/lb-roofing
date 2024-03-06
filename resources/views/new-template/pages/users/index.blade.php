@extends('new-template.layouts.base')
@section('title', __('lang.users'))
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{ __('lang.user.user_administration_panel') }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("dashboard")}}">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.user.users') }}</li>
            </ol>
        </div>
        <div class="d-flex">
            <div class="justify-content-center">

                @if(auth()->user()->isAdmin())
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create-user"><i
                        class="fa-solid fa-user-plus ml-1"></i> {{ __('lang.user.add_user') }}</button>
                @endif

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-view-rol"><i
                        class="fa-solid fa-toolbox"></i> {{ __('lang.roles') }}</button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-view-status" ><i
                        class="ti-settings"></i> {{ __('lang.status') }}
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                    @livewire('usuario-table')
            </div>
        </div>
    </div>

    @if(auth()->user()->isAdmin())
    <!-- Modal para crear usuarios -->
    <div class="modal fade" id="modal-create-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="title-create-user" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-create-user"> </h5>
                    <button type="button" class="btn-close dark-mode" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                        <livewire:forms-nuevo-usuario/>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
@push('modals')
    <!-- Modal para ver los role -->
    <div class="modal fade" id="modal-view-status" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"> {{ __('lang.user.states_available') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <livewire:estado-table/>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para ver los role -->
    <div class="modal fade" id="modal-view-rol" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"> {{ __('lang.user.roles_available') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <livewire:rol-table/>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('script')
    <script>
        const modalUser = $("#modal-create-user")
        const formUser = $('#form-new-user')
        const titleCreateUser = $('#title-create-user');

        modalUser.on("show.bs.modal", function (e) {
            const elementAction = e.relatedTarget;
            if (elementAction) {
                const elementHtml = $(elementAction);
                if (!elementHtml.attr('data-user')) {
                    Livewire.dispatch('add-user');
                } else {
                    Livewire.dispatch('edit-user',{ id : elementHtml.attr('data-user')});
                }
            }
        });

        window.addEventListener('text-action-user', event => {
            if (titleCreateUser.length) {
                titleCreateUser.text(event.detail.text)
            }
        });

        modalUser.on("hidden.bs.modal", function () {
            //reset form
            formUser.trigger("reset");
        });
    </script>
@endpush
