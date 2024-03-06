@extends('new-template.layouts.base')
@section('title',__('lang.invoice'))
@section('content')
    @php $invoiceId = request()->route()->parameters()['invoice_id']; @endphp
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{ __('lang.invoice') }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("dashboard")}}">{{ __('lang.home')  }}</a></li>
                <li class="breadcrumb-item">{{ __('lang.project.projects')  }}</li>
                <li class="breadcrumb-item">{{ __('lang.invoice')  }}</li>
            </ol>
            @if(\App\Models\Usuario::accessAllowed())
                <div class="col-md-12">
                    @livewire('cambiar-estado-factura', ['invoice_id' => $invoiceId])
                </div>
            @endif
        </div>
        <div class="d-flex">
            <div class="justify-content-center">
                <input hidden class="form-control"
                       value="{{ \App\Livewire\FacturaDone::generateLinkShare($invoiceId) }}" type="text"
                       readonly id="link-share-admin">
                <button data-clipboard-target="#link-share-admin" class="btn ripple btn-primary copy-clipboard" type="button">
                    <i class="fa fa-copy"></i> {{ __('lang.share') }}
                </button>
                <a class="btn btn-primary" href="{{ route('view-project', ['id' => $id]) }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    {{ __('back') }}
                </a>
            </div>
        </div>
    </div>
    {{--<div class="card" hidden>
        <div class="card-body">
            <div class="col-md-12">
                @livewire('forms-nueva-factura', ['id' => $id, 'invoice_id' => $invoice_id])
            </div>
        </div>
    </div>--}}
    <!-- Invoice Generate -->
    @if($invoiceId)
        @livewire('factura-done', ['project_id' => $id,'invoice_id' => $invoiceId])
    @endif
@endsection
@push('script')
    <script>
        // resuelve el bug de la barra de navegacion
        $(document).ready(function () {
            $(".nav-item").removeClass("active");
            $("a[href$='projects']").closest("li").addClass("active");
        });
    </script>
@endpush
