@extends('new-template.layouts.base')
@section('title', __('lang.quote.quote'))
@push('style')
    <style>
.checkbox-wrapper-16 *,
.checkbox-wrapper-16 *:after,
.checkbox-wrapper-16 *:before {
  box-sizing: border-box;
}

.checkbox-wrapper,
.checkbox-tile {
    width: 100% !important;
}

.checkbox-wrapper-16 .checkbox-input {
  clip: rect(0 0 0 0);
  -webkit-clip-path: inset(100%);
  clip-path: inset(100%);
  height: 1px;
  overflow: hidden;
  position: absolute;
  white-space: nowrap;
  width: 1px;
}

.checkbox-wrapper-16 .checkbox-input:checked + .checkbox-tile {
  border-color: #dc3545;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  color: #dc3545;
}

.checkbox-wrapper-16 .checkbox-input:checked + .checkbox-tile:before {
  transform: scale(1);
  opacity: 1;
  background-color: #dc3545;
  border-color: #dc3545;
  color: #fff;
  content: "✓";
}

.checkbox-wrapper-16 .checkbox-input:checked + .checkbox-tile,
  .checkbox-wrapper-16 .checkbox-input:checked + .checkbox-tile .checkbox-label {
  color: #dc3545;
}

.checkbox-wrapper-16 .checkbox-input:focus + .checkbox-tile {
  border-color: #dc3545;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4px rgba(203, 109, 119, 0.86);
}

.checkbox-wrapper-16 .checkbox-input:focus + .checkbox-tile:before {
  transform: scale(1);
  opacity: 1;
}

.checkbox-wrapper-16 .checkbox-tile {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 7rem;
  border-radius: 0.5rem;
  border: 2px solid #b5bfd9;
  background-color: #fff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  transition: 0.15s ease;
  cursor: pointer;
  position: relative;
}

.checkbox-wrapper-16 .checkbox-tile:before {
  content: "";
  font-size: 12px;
  position: absolute;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 1.25rem;
  height: 1.25rem;
  border: 2px solid #b5bfd9;
  border-radius: 50%;
  top: 0.25rem;
  left: 0.25rem;
  opacity: 0;
  transform: scale(0);
  transition: 0.25s ease;
}

.checkbox-wrapper-16 .checkbox-tile:hover {
  border-color: #dc3545;
}

.checkbox-wrapper-16 .checkbox-tile:hover:before {
  transform: scale(1);
  opacity: 1;
}
    </style>
@endpush
@section('content')
    <!-- Row -->
    <div class="row sidemenu-height mt-5">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-lg-flex">
                        <div class="main-content-body main-content-body-contacts">
                            <div class="main-contact-info-header border-0 p-0 pt-3">
                                <div class="media">
                                    <div class="main-img-user">
                                        <img alt="avatar" src="{{ asset('assets/img/logo/LB-Roofing-LLC.png') }}">
                                    </div>
                                    <div class="media-body">
                                        <h2 class="main-content-title tx-24 mg-b-5">{{ $quote->proyecto->titulo	 }}</h2>
                                        <address>{{ $quote->proyecto->direccion }}</address>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mg-b-40">
                    <div class="row row-sm">
                        <div class="col-lg-12">
                            <p class="h3">{{ __('lang.quote.quote_form') }}:</p>

                            <p class="mb-1"><span class="font-weight-bold">{{ __('lang.name') }} :</span> {{ $quote->name }}</p>
                            <p class="mb-1"><span class="font-weight-bold">{{ __('lang.status') }} :</span> {{ $quote->estado_cotizacion->nombre }}</p>
                            <p class="mb-1"><span class="font-weight-bold">{{ __('lang.quote.quote_date') }} :</span> {{ date('Y-m-d', strtotime($quote->fecha_emision)) }}</p>
                            <p class="mb-1"><span class="font-weight-bold">{{ __('lang.due_date') }} :</span> {{ date('Y-m-d', strtotime($quote->fecha_vencimiento)) }}</p>
                        </div>
                    </div>
                    <div class="table-responsive mg-t-40">
                        <table class="table table-invoice table-bordered">
                            <thead>
                            <tr>
                                <th class="wd-20p">{{ __('lang.provider') }}</th>
                                <th class="wd-20p">{{ __('lang.product.product') }}</th>
                                <th class="tx-center">{{ __('lang.quantity') }}</th>
                                <th class="tx-right">{{ __('lang.price') }}</th>
                                <th class="tx-right">{{ __('lang.discount') }}</th>
                                <th class="tx-right">{{ __('lang.tax') }}</th>
                                <th class="tx-right">{{ __('lang.total') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($quote->cotizacion_items as $item)
                                <tr>
                                    <td>{{ $item->producto->proveedor->nombre }}</td>
                                    <td class="tx-12">{{ $item->producto->nombre }}</td>
                                    <td class="tx-center">{{ $item->cantidad }}</td>
                                    <td class="tx-right">{{ MoneyHelper::format($item->precio) }}</td>

                                    <td class="tx-right">{{ MoneyHelper::format($item->descuento) }}</td>
                                    <td class="tx-right">{{ MoneyHelper::format($item->tax) }}</td>
                                    <td class="tx-right">{{ MoneyHelper::format($item->sub_total) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td class="valign-middle" colspan="4" rowspan="4">
                                    <div class="invoice-notes">
                                        <label class="main-content-label tx-13">{{ __('lang.notes') }} :</label>
                                        <p>{{ $quote->observaciones }}</p>
                                    </div>
                                </td>
                                <td style="color: #76769c;" class="tx-right font-weight-semibold">{{ __('lang.sub_total') }}</td>
                                <td class="tx-right" colspan="2">{{ MoneyHelper::format($quote->subtotal - $quote->tax) }}</td>
                            </tr>
                            <tr>
                                <td class="tx-right">{{ __('lang.discount') }}</td>
                                <td class="tx-right" colspan="2">{{ MoneyHelper::format($quote->descuento) }}</td>
                            </tr>
                            <tr>
                                <td class="tx-right">{{ __('lang.tax') }}</td>
                                <td class="tx-right" colspan="2">{{ MoneyHelper::format($quote->tax) }}</td>
                            </tr>
                            <tr>
                                <td class="tx-right tx-uppercase tx-bold tx-inverse">{{ __('lang.total') }}</td>
                                <td class="tx-right" colspan="2">
                                    <h4 class="tx-bold">{{ MoneyHelper::format($quote->total) }}</h4>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    @if($clientStatusQuote)
                        <hr class="mg-b-40">
                        <form id="save-response-quote-client"
                              action="{{ route('save-response-quote-client', ['uuid' => $quote->uuid, 'sent_uuid' => $clientStatusQuote->uuid]) }}" method="post">
                            <div class="text-center flex row">
                                <div class="col-md-4">
                                    <button class="button btn-success w-100 btn-rounded p-2" type="button" id="accept">
                                        <i class="fa fa-check"></i>
                                        <span style="font-size: 15px">
                                        {{ __('lang.accept') }}
                                    </span>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button class="button btn-warning w-100 btn-rounded p-2" type="button" id="review">
                                        <i class="ti-write"></i>
                                        <span style="font-size: 15px">
                                        {{ __('lang.review') }}
                                    </span>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <div class="checkbox-wrapper-16">
                                        <label class="checkbox-wrapper">
                                            <input class="checkbox-input" type="checkbox"  name="answer-user" id="answer-user-3"
                                                   value="{{ \App\Models\EstadoCotizacion::CANCELED }}" {{ $clientStatusQuote->estado_cotizacion ? 'disabled' : '' }} {{ $clientStatusQuote->estado_cotizacion == \App\Models\EstadoCotizacion::CANCELED ? 'checked' : '' }}>
                                            <span class="checkbox-tile">
                                            <span class="checkbox-label p-2"><i class="fa fa-cancel"></i> {{ __('lang.reject') }}</span>
                                        </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @csrf
                            <div id="commentBox" class="row" hidden>
                                <label for="user-quote-comment" class="col-sm-2 col-form-label">{{ __('lang.comment') }}
                                    :</label>
                                <textarea placeholder="{{__('lang.quote.request_revision')}}" name="user-quote-comment"
                                          class="form-control" id="user-quote-comment" cols="30"
                                          rows="10" {{ $clientStatusQuote->estado_cotizacion ? 'disabled' : '' }}>{{ $clientStatusQuote->comentario ?? '' }}</textarea>
                            </div>
                            <div id="signature-pad" class="row" hidden>
                                <label for="" class="col-form-label">{{ __('lang.signature.signature') }}</label>
                                <div class="text-center">
                                    @if($clientStatusQuote->estado_cotizacion == \App\Models\EstadoCotizacion::NONE)
                                        <canvas class="border" id="canva-user-quote-signature"></canvas>
                                        <input type="hidden" id="user-quote-signature" name="user-quote-signature">
                                    @elseif($clientStatusQuote->firma)
                                        <img src="{{ $clientStatusQuote->firma }}" class="img-fluid img-thumbnail"/>
                                    @endif

                                    @if($clientStatusQuote->estado_cotizacion == \App\Models\EstadoCotizacion::NONE)
                                        <div class="mt-3">
                                            <button id="clear-signature" type="button"
                                                    class="btn btn-primary">{{ __('lang.clear') }}</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if($clientStatusQuote->estado_cotizacion == \App\Models\EstadoCotizacion::NONE)
                                <button type="submit" class="btn btn-primary">{{ __('lang.send') }}</button>
                            @endif
                        </form>

                        @push('script')
                            <script src="{{ asset('assets/js/signature_pad.umd.min.js') }}"></script>

                            <script>

                                $(function () {
                                    const canvas = document.getElementById("canva-user-quote-signature");
                                    const inputSignature = $("#user-quote-signature");
                                    const formUserQuoteSignature = $("#save-response-quote-client");
                                    if (canvas) {
                                        const signaturePad = new SignaturePad(canvas, {
                                            penColor: "rgb(66, 133, 244)"
                                        });

                                        $(document).on('click', '#clear-signature', function () {
                                            signaturePad.clear();
                                        })

                                        formUserQuoteSignature.on( "submit", function( event ) {
                                            if (signaturePad.isEmpty()) {
                                                Swal.fire({
                                                    title: "{{ __('lang.signature.is_empty') }}",
                                                    icon: "warning"
                                                });
                                                event.preventDefault();
                                            }
                                            inputSignature.val(signaturePad.toDataURL('image/png').toString())
                                        });
                                    }
                                })
                            </script>
                        @endpush
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
@push('script')
    <script>
        $(document).on('click', '#accept', function () {
            $('#signature-pad').removeAttr('hidden');
            // si commentBox esta visible, lo ocultamos
            if (!$('#commentBox').attr('hidden')) {
                $('#commentBox').attr('hidden', 'hidden');
            }
            $('#answer-user-3').prop('checked', false);
        });
        $(document).on('click', '#review', function () {
            $('#commentBox').removeAttr('hidden');
            $('#answer-user-3').prop('checked', false);
        });
        $(document).on('change', '#answer-user-3', function () {
            if ($(this).is(':checked')) {
                $('#signature-pad').removeAttr('hidden');
                // si commentBox esta visible, lo ocultamos
                if (!$('#commentBox').attr('hidden')) {
                    $('#commentBox').attr('hidden', 'hidden');
                }
            } else {
                $('#signature-pad').attr('hidden', 'hidden');
            }
        });
    </script>
@endpush
