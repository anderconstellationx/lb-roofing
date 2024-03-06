@extends('new-template.layouts.base')
@section('title', __('lang.project.projects'))
@push('style')
    <style>

    </style>
@endpush
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{ __('lang.reports') }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("dashboard")}}">{{ __('lang.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.reports') }}</li>
            </ol>
        </div>
        <div class="d-flex">
            <div class="justify-content-center">

            </div>
        </div>
    </div>

    <div>
        @livewire('report.chart.pie')
    </div>
@endsection
@push('modals')

@endpush
@push('script')

@endpush
