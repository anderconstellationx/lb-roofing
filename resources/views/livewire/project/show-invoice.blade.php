@extends('new-template.layouts.base')
@section('title', $invoice->codigo_factura)
@section('content')
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body" id="invoice-roofing">
                    <div class="logo">
                        <img style="width: 100px" src="{{asset('assets/img/logo/LB-Roofing-LLC.png')}}" alt="Roofing">
                    </div>
                    <div class="d-lg-flex">
                        <h2 class="main-content-label mb-1">{{$invoice->codigo_factura}}</h2>
                        <div class="ms-auto">
                            <div class="text-center">
                                {!! $infoEstado !!}
                            </div>
                            <p class="mb-1"><span
                                    class="font-weight-bold">Invoice Date : </span>{{$invoice->fecha_emision}}
                            </p>
                            <p class="mb-0"><span
                                    class="font-weight-bold">Due Date : </span>{{$invoice->fecha_vencimiento}}
                            </p>
                        </div>
                    </div>
                    <hr class="mg-b-40">
                    <div class="row row-sm">
                        <div class="col-lg-6">
                            <p class="h3">Invoice From:</p>
                            <address>
                                LB Roofing LLC<br>
                                lbroofing@support.com
                            </address>
                        </div>
                        <div class="col-lg-6 text-end">
                            <p class="h3">Invoice To:</p>
                            {{ __('lang.client')  }}: <strong>{{$cliente->getCompleteName()}}</strong><br>
                            {{ __('lang.email')  }}: {{$cliente->email}}<br>
                            {{ __('lang.direction')  }}: {{ empty($cliente->direccion) ? 'N/A' : $cliente->direccion }}
                            <br>
                            {{ __('lang.phone')  }}: {{ empty($cliente->telefono) ? 'N/A' : $cliente->telefono }}<br>
                        </div>
                    </div>
                    <div class="table-responsive mg-t-40">
                        <table class="table table-invoice table-bordered">
                            <thead>
                            <tr>
                                <th class="wd-20p">{{__('lang.product.product')}}</th>
                                <th class="tx-center">{{__('lang.quantity')}}</th>
                                <th class="tx-center">{{__('lang.price')}}</th>
                                <th class="tx-center">{{__('lang.tax')}}</th>
                                <th class="tx-center">{{__('lang.discount')}}</th>
                                <th class="tx-center">{{__('lang.subtotal')}}</th>
                                <th class="tx-center">{{__('lang.total')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($itemsCotizacion as $item)
                                @foreach($productos as $product)
                                    @if($product->id == $item->producto_id)
                                        <tr>
                                            <td>{{ $product->nombre }}</td>
                                            <td class="tx-center">{{ $item->cantidad }}</td>
                                            <td class="tx-center"> $ {{ number_format($item->precio, 2) }}</td>
                                            <td class="tx-center"> $ {{ number_format($item->tax, 2) }}</td>
                                            <td class="tx-center">
                                                $ {{ !empty($item->descuento) ? number_format($item->descuento, 2) : '0.00' }}</td>
                                            <td class="tx-center"> $ {{ number_format($item->sub_total, 2) }}</td>
                                            <td class="tx-right"> $ {{ number_format($item->total, 2) }}</td>
                                        </tr>
                                        @break
                                    @endif
                                @endforeach
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <td><strong>{{__('lang.subtotal')}}</strong></td>
                                <td class="tx-right" colspan="6"> $ {{ $cotizacion->subtotal - $cotizacion->tax }}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('lang.tax')}}</strong></td>
                                <td class="tx-right" colspan="6">$ {{ $cotizacion->tax }}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('lang.total')}}</strong></td>
                                <td class="tx-right" colspan="6">$ {{ $cotizacion->total }}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button id="print" type="button" class="btn ripple btn-info mb-1" onclick="window.print()">
                        <i class="fe fe-printer me-1"></i>
                        Print Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        #estadoFactura {
            font-size: 1.5rem;
        }
        @media print {
            #print {
                display: none;
            }
        }
    </style>
@endpush
