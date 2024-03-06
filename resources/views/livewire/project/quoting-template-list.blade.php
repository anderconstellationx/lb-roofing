@extends('new-template.layouts.base')
@section('title', __('lang.quote.template_quote_list'))
@section('content')
        <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{ __('lang.quote.template_quote') }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ __('lang.home')  }}</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('quote-template-list') }}">{{ __('lang.quote.template_quote_list') }}</a></li>
            </ol>
        </div>
        <div class="d-flex">
            <div class="justify-content-center">
                <a class="btn btn-primary" href="{{ route('quote-template', ['quote_template_id' => 0]) }}"><i
                        class="fe fe-plus"></i> {{ __('lang.add') }}</a>
            </div>
        </div>
    </div>
    <div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        @livewire('TemplateCotizacionTable')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
