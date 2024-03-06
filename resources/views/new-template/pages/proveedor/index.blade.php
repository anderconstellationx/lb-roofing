@extends('new-template.layouts.base')
@section('title', __('lang.sidebar.providers'))
@push('style')
@endpush
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{ __('lang.sidebar.providers') }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("dashboard")}}">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.provider') }}</li>
            </ol>
        </div>
        <div class="d-flex">
            <div class="justify-content-center">
                <a class="btn btn-primary" href="{{ route('dashboard')}}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('lang.back') }}
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    @livewire('proveedor-table')
                </div>
            </div>
        </div>
    </div>
@endsection


