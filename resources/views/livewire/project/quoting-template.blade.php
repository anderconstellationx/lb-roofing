@extends('new-template.layouts.base')
@section('title', __('lang.quote.template_quote'))
@section('content')
        <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{ __('lang.quote.template_quote') }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ __('lang.home')  }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('quote-template-list') }}">{{ __('lang.quote.template_quote_list') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.add')  }}</li>
            </ol>
        </div>
        <div class="d-flex">
            <div class="justify-content-center">
                <a class="btn btn-primary" href="{{ route('quote-template-list') }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('lang.back') }}
                </a>
            </div>
        </div>
    </div>
    <div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        @livewire('agregar-cotizacion', ['id' => 0, 'quote_id' => 0, 'is_template' => true])
                    </div>
                </div>
            </div>
        </div>
        {{-- @livewire('template-cotizacion-table')--}}
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $(".nav-item").removeClass("active");
            $("a[href$='template-message']").closest("li").addClass("active");
        });
    </script>
@endpush
