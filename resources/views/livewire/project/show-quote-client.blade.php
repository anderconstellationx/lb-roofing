@extends('new-template.layouts.base')
@section('title', __('lang.quote.quote'))
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
                        <div class="col-md-6">
                            <p class="h3">{{ __('lang.quote.quote_form') }}:</p>

                            <p class="mb-1"><span
                                    class="font-weight-bold">{{ __('lang.name') }} :</span> {{ $quote->name }}</p>
                            <p class="mb-1"><span
                                    class="font-weight-bold">{{ __('lang.status') }} :</span> {{ $quote->estado_cotizacion->nombre }}
                            </p>
                            <p class="mb-1"><span
                                    class="font-weight-bold">{{ __('lang.quote.quote_date') }} :</span> {{ date('Y-m-d', strtotime($quote->fecha_emision)) }}
                            </p>
                            <p class="mb-1"><span
                                    class="font-weight-bold">{{ __('lang.due_date') }} :</span> {{ date('Y-m-d', strtotime($quote->fecha_vencimiento)) }}
                            </p>
                        </div>

                        <div class="col-md-6 text-md-end">
                            <p class="h3">{{ __('lang.customer') }}:</p>
                            <p class="mb-1"></span> {{ $quote->proyecto->usuario_cliente->getCompleteName() }}</p>
                            <p class="mb-1">{{ $quote->proyecto->usuario_cliente->direccion }}</p>
                            <p class="mb-1"></span> {{ $quote->proyecto->usuario_cliente->telefono }}</p>
                            <p class="mb-1"></span> {{ $quote->proyecto->usuario_cliente->email }}</p>
                        </div>
                    </div>


                    <div class="table-responsive mg-t-40">
                        <table class="table table-invoice table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="wd-20p">{{ __('lang.description') }}</th>
                                <th class="wd-20p tx-right">{{ __('lang.price') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $clientStatusQuote->titulo }}</td>
                                <td class="tx-right">{{ MoneyHelper::format($quote->subtotal - $quote->tax) }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">{!! $clientStatusQuote->mensaje_cliente !!}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="invoice-notes">
                                        <label class="main-content-label tx-13">{{ __('lang.notes') }} :</label>
                                        <p>{{ $quote->observaciones }}</p>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="color: #76769c;"
                                    class="tx-right font-weight-semibold">{{ __('lang.sub_total') }}</td>
                                <td class="tx-right"
                                    colspan="2">{{ MoneyHelper::format($quote->subtotal - $quote->tax) }}</td>
                            </tr>
                            <tr>
                                <td class="tx-right">{{ __('lang.discount') }}</td>
                                <td class="tx-right">{{ MoneyHelper::format($quote->descuento) }}</td>
                            </tr>
                            <tr>
                                <td class="tx-right">{{ __('lang.tax') }}</td>
                                <td class="tx-right">{{ MoneyHelper::format($quote->tax) }}</td>
                            </tr>
                            <tr>
                                <td class="tx-right tx-uppercase tx-bold tx-inverse">{{ __('lang.total') }}</td>
                                <td class="tx-right">
                                    <h4 class="tx-bold">{{ MoneyHelper::format($quote->total) }}</h4>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    @if($clientStatusQuote)
                        <hr class="mg-b-40">
                        <form id="save-response-quote-client"
                              action="{{ route('save-response-quote-client', ['uuid' => $quote->uuid, 'sent_uuid' => $clientStatusQuote->uuid]) }}"
                              method="post">
                            @csrf

                            @if($clientStatusQuote->estado_cotizacion == \App\Models\EstadoCotizacion::NONE)
                                <div class="row" id="buttons-container">
                                    <div class="col-lg-4">
                                        <div class="d-grid gap-2">
                                            <button class="btn ripple btn-primary btn-rounded toggle-button"
                                                    type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse-accept"
                                                    aria-expanded="false" aria-controls="collapse-accept">
                                                <i class="fa fa-check"></i> {{ __('lang.quote.accept_and_sign_change_order') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-grid gap-2">
                                            <button class="btn ripple btn-outline-primary btn-rounded toggle-button"
                                                    type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse-review"
                                                    aria-expanded="false" aria-controls="collapse-review"
                                            >
                                                <i class="ti-write"></i> {{ __('lang.quote.request_revision') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="d-grid gap-2">
                                            <button class="btn ripple btn-outline-primary btn-rounded toggle-button"
                                                    type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse-rejected"
                                                    aria-expanded="false" aria-controls="collapse-rejected"

                                            >
                                                <i class="fas fa-cancel"></i> {{ __('lang.quote.reject_change_order') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12" id="canva-user-quote-signature-container"></div>
                                </div>

                                <div class="collapse" data-collapse="{{ \App\Models\EstadoCotizacion::ACCEPTED }}"
                                     id="collapse-accept">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>{{ __('lang.quote.accept_and_sign_change_order') }}</h4>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="">{{ __('lang.your_full_name') }}</label>
                                                    <input type="text" class="form-control"
                                                           placeholder="{{ __('lang.your_full_name') }}"
                                                           value="{{ $quote->proyecto->usuario_cliente->getCompleteName() }}">
                                                </div>
                                                <div class="col-6 text-end">
                                                    <button type="button"
                                                            class="btn ripple btn-outline-primary btn-rounded cancel-button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapse-accept"
                                                            aria-expanded="false" aria-controls="collapse-accept">
                                                        <i class="fas fa-cancel"></i> {{ __('lang.cancel') }}
                                                    </button>
                                                    <div>
                                                        <span>{{ __('lang.date_signed', ['date' => date('M d, Y')]) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mg-t-10">
                                                <canvas class="border" id="canva-user-quote-signature"
                                                        height="300"></canvas>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <button id="clear-signature" type="button"
                                                            class="btn ripple btn-outline-primary btn-rounded"><i
                                                            class="fas fa-eraser"></i> {{ __('lang.clear') }}</button>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <button class="btn ripple btn-primary btn-rounded"
                                                            name="answer-user"
                                                            value="{{ \App\Models\EstadoCotizacion::ACCEPTED }}"
                                                            type="submit">
                                                        <i class="fa fa-check"></i> {{ __('lang.quote.submit_signature') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="collapse" id="collapse-review"
                                     data-collapse="{{ \App\Models\EstadoCotizacion::REVISION }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>{{ __('lang.quote.request_change_order_revision') }}</h4>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="">{{ __('lang.your_full_name') }}</label>
                                                    <input type="text" class="form-control"
                                                           placeholder="{{ __('lang.your_full_name') }}"
                                                           value="{{ $quote->proyecto->usuario_cliente->getCompleteName() }}">
                                                </div>
                                                <div class="col-6 text-end">
                                                    <button type="button"
                                                            class="btn ripple btn-outline-primary btn-rounded cancel-button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapse-review"
                                                            aria-expanded="false" aria-controls="collapse-review">
                                                        <i class="fas fa-cancel"></i> {{ __('lang.cancel') }}
                                                    </button>
                                                    <div>
                                                        <span>{{ __('lang.date_requested', ['date' => date('M d, Y')]) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mg-t-10">
                                                <textarea name="" id=""
                                                          placeholder="{{ __('lang.quote.requested_revisions') }}..."
                                                          class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 ">
                                            <div class="text-end mg-t-5">
                                                <button class="btn ripple btn-primary btn-rounded" name="answer-user"
                                                        value="{{ \App\Models\EstadoCotizacion::REVISION }}"
                                                        type="submit">
                                                    <i class="fa fa-check"></i> {{ __('lang.quote.submit_revision_request') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="collapse" id="collapse-rejected"
                                     data-collapse="{{ \App\Models\EstadoCotizacion::CANCELED }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>{{ __('lang.quote.reject_change_order') }}</h4>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="">{{ __('lang.your_full_name') }}</label>
                                                    <input type="text" class="form-control"
                                                           placeholder="{{ __('lang.your_full_name') }}"
                                                           value="{{ $quote->proyecto->usuario_cliente->getCompleteName() }}">
                                                </div>
                                                <div class="col-6 text-end">
                                                    <button type="button"
                                                            class="btn ripple btn-outline-primary btn-rounded cancel-button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse-rejected" aria-expanded="false"
                                                            aria-controls="collapse-rejected">
                                                        <i class="fas fa-cancel"></i> {{ __('lang.cancel') }}
                                                    </button>
                                                    <div>
                                                        <span>{{ __('lang.date_rejected', ['date' => date('M d, Y')]) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mg-t-10">
                                                <textarea name="" id=""
                                                          placeholder="{{ __('lang.quote.reason_for_rejecting') }}..."
                                                          class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 ">
                                            <div class="text-end mg-t-5">
                                                <button class="btn ripple btn-primary btn-rounded" name="answer-user"
                                                        value="{{ \App\Models\EstadoCotizacion::CANCELED }}"
                                                        type="submit">
                                                    <i class="fa fa-check"></i> {{ __('lang.quote.submit_rejection') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="user-quote-signature" name="user-quote-signature">
                                <input type="hidden" id="user-quote-message" name="user-quote-message">
                            @else
                                <p><strong><i
                                            class="fas fa-check-circle"></i> {{ __(\App\Models\EstadoCotizacion::STATUS_SHOW_CLIENT[$clientStatusQuote->estado_cotizacion]) }}
                                    </strong></p>

                                @switch($clientStatusQuote->estado_cotizacion)
                                    @case(\App\Models\EstadoCotizacion::ACCEPTED)
                                        <img src="{{ $clientStatusQuote->firma }}" alt="">
                                        @break
                                    @case(\App\Models\EstadoCotizacion::REVISION)
                                    @case(\App\Models\EstadoCotizacion::CANCELED)
                                        <h5>{{ __('lang.comment') }}:</h5>
                                        <p>{{ $clientStatusQuote->comentario }}</p>
                                        @break
                                @endswitch
                            @endif
                        </form>

                        @push('script')
                            <script src="{{ asset('assets/js/signature_pad.umd.min.js') }}"></script>

                            <script>
                                $(function () {
                                    const canvas = document.getElementById("canva-user-quote-signature");
                                    const canvasContainer = $("#canva-user-quote-signature-container");
                                    canvas.width = canvasContainer.width()
                                    canvas.height = 300

                                    const inputSignature = $("#user-quote-signature");
                                    const inputMessage = $("#user-quote-message");
                                    if (canvas) {
                                        const signaturePad = new SignaturePad(canvas, {
                                            penColor: "#000",
                                        });

                                        $(document).on('click', '#clear-signature', function () {
                                            signaturePad.clear();
                                        })

                                        $(document).on('click', 'button[name="answer-user"]', function (event) {
                                            const value = $(this).val();
                                            if (value == '{{ \App\Models\EstadoCotizacion::ACCEPTED }}' && signaturePad.isEmpty()) {
                                                Swal.fire({
                                                    title: "{{ __('lang.signature.is_empty') }}",
                                                    icon: "warning"
                                                });
                                                event.preventDefault();
                                            } else {
                                                inputSignature.val(signaturePad.toDataURL('image/png').toString())
                                                signaturePad.clear();
                                            }

                                            if (value == '{{ \App\Models\EstadoCotizacion::REVISION }}' || value == '{{ \App\Models\EstadoCotizacion::CANCELED }}') {
                                                const containerMessage = $('div[data-collapse="' + value + '"] textarea');
                                                if (containerMessage.length > 0) {
                                                    inputMessage.val(containerMessage.val())
                                                }
                                                inputSignature.val('')
                                            }
                                        });
                                    }

                                    $(document).on('click', '.toggle-button, .cancel-button', function (e) {
                                        $("#buttons-container").toggle();
                                    });
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
