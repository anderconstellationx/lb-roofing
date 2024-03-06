<!-- Row -->
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
                        <p class="mb-1"><span class="font-weight-bold">Invoice Date : </span>{{$invoice->fecha_emision}}
                        </p>
                        <p class="mb-0"><span class="font-weight-bold">Due Date : </span>{{$invoice->fecha_vencimiento}}
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
                        {{ __('lang.direction')  }}: {{ empty($cliente->direccion) ? 'N/A' : $cliente->direccion }}<br>
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
                                        <td class="tx-center"> $ {{ number_format($item->total, 2) }}</td>
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
                {{--
                <div class="row" hidden>
                    @if(empty($invoice->firma))
                    <div class="col-md-3">
                        <div class="card custom-card">
                            @livewire('signature-pad', ['id' => $proyecto->id ,'invoice_id' => $invoice->id])
                            <button id="addSignature" class="btn btn-rounded btn-danger" onclick="signaturePad()">
                                <i class="fab fa-500px"></i>
                                <span>{{__('lang.signature.signature')}}</span>
                            </button>
                        </div>
                    </div>
                    @else
                    <div class="card-body text-center">
                        <img src="{{$invoice->firma}}" alt="LB-Roofing" style="border-bottom: 1px solid black">
                        <h4>{{$cliente->getCompleteName()}}</h4>
                        <h5 style="padding: 0; margin-top: 0">{{ $cliente->documento }}</h5>
                    </div>
                    @endif
                </div>
                --}}
            </div>
            <div class="card-footer text-end">
                {{--
                <button type="button" class="btn ripple btn-secondary mb-1"><i
                    class="fe fe-send me-1"></i> Send Invoice
                </button>
                --}}
                <button id="print" type="button" class="btn ripple btn-info mb-1" onclick="window.print()">
                    <i class="fe fe-printer me-1"></i>
                    Print Invoice
                </button>
            </div>
        </div>
    </div>
</div>
{{--
 @push('script')
    <script>
        function signaturePad() {
            modifyButtons();

            function modifyButtons() {
                const button = document.getElementById('addSignature');
                button.innerHTML = '<i class="fas fa-save"></i> <span>Save Signature</span>';
                button.removeAttribute('onclick');
                button.addEventListener('click', function () {
                    saveSignature();
                });
                const signaturePad = document.getElementById('signaturePath');
                signaturePad.removeAttribute('hidden');
            }

            var canvas = document.getElementById('signature-pad');
            var isDrawing = false;

            function resizeCanvas() {
                var ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
            }

            window.onresize = resizeCanvas;
            resizeCanvas();

            var signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)'
            });

            document.getElementById('clear').addEventListener('click', function () {
                signaturePad.clear();
                isDrawing = false;
            });

            document.getElementById('undo').addEventListener('click', function () {
                var data = signaturePad.toData();
                if (data) {
                    data.pop();
                    signaturePad.fromData(data);
                    isDrawing = data.length > 0;
                }
            });

            function saveSignature() {
                var data = signaturePad.toDataURL('image/png');
                data = data.toString();
                Livewire.dispatch('saveSignature', {imageData: data});
                const button = document.getElementById('addSignature');
                button.innerHTML = '<i class="fab fa-500px"></i> <span>{{__("eng.signature")}}</span>';
            }

            document.getElementById('addSignature').addEventListener('click', function () {
                saveSignature();
            });
        }

    </script>
@endpush
--}}
@push('style')
    <style>
        #estadoFactura {
            font-size: 1.5rem;
        }
        @media print {
            #print,
            #estadoFactura,
            .page-header,
            .side-header{
                display: none;
            }
        }
    </style>
@endpush

<!-- End Row -->
