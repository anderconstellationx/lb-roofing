@extends('new-template.layouts.base')
@section('Detalle','detail-page')
@section('content')
    @php
        $disabled = \App\Models\Usuario::accessAllowed() ? '' : 'hidden';
        $allowed = \App\Models\Usuario::accessAllowed();
    @endphp
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">{{ __('lang.quote.quote') }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route("dashboard")}}">{{ __('lang.home')  }}</a></li>
                <li class="breadcrumb-item">{{ __('lang.project.projects')  }}</li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('lang.quote.quote')  }}</li>
            </ol>
        </div>
        <div class="d-flex">
            <div class="justify-content-center">
                @if($allowed)
                    @if($quote_id)
                        <button
                            type="button"
                            class="btn btn-white btn-icon-text my-2 me-2"
                            data-bs-toggle="modal"
                            data-bs-target="#shareModal"
                        >
                            <i class="fe fe-share me-2"></i> {{ __('lang.share') }}
                        </button>

                        @if(\App\Livewire\AgregarCotizacion::matchStatus($quote_id))
                            <button id="send-email-quote" type="button" class="btn btn-white btn-icon-text my-2 me-2"
                                    data-bs-toggle="modal" data-bs-target="#send-message-client">
                                <i class="fe fe-send me-2"></i>
                                {{ __('lang.send') }}
                            </button>
                        @endif

                    @elseif(\App\Models\TemplateCotizacion::getQuoteAsTemplate())
                        <button
                            type="button"
                            class="btn btn-white btn-icon-text my-2 me-2"
                            data-bs-target="#modal-quote-as-template" data-bs-toggle="modal"
                        >
                            <i class="fe fe-file-text me-2"></i> {{ __('lang.template') }}
                        </button>
                    @endif
                @endif
                <a class="btn btn-primary" href="{{ route('view-project', ['id' => $id]) }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('lang.back') }}
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    @livewire('agregar-cotizacion', ['id' => $id, 'quote_id' => $quote_id, 'is_template' => false])
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    {{--para elegir elegir plantilla de cotizacion--}}
    <div class="modal" id="modal-quote-as-template" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                @push('style')
                    <style>
                        #form-save-quote-template-in-project .select2-search__field {
                            width: 100% !important;
                        }
                    </style>
                @endpush
                <form id="form-save-quote-template-in-project"
                      action="{{ route('save-quote-template-in-project', ['project_id' => $id]) }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h6 class="modal-title">{{ __('lang.choose') }}</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <select name="quote-id[]" class="select2" multiple>
                                    @foreach(\App\Models\TemplateCotizacion::getQuoteAsTemplate() as $item)
                                        <option value="{{ $item['id'] }}"> {{ $item['name'] }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit"><i
                                class="fas fa-save"></i> {{ __('lang.save') }}</button>
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button"><i
                                class="fas fa-close"></i> {{ __('lang.cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if($quote_id && $allowed)
        @livewire('share-and-send-link', ['link' => \App\Livewire\AgregarCotizacion::generateLinkShare($quote_id), 'linkClient' => \App\Livewire\AgregarCotizacion::generateLinkShare($quote_id, true) , 'id' => $id, 'quote_id' => $quote_id])
        <div class="modal fade" id="send-message-client" data-bs-backdrop="static" data-bs-keyboard="false"
             tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{ __('lang.sent_to_client') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="fas fa-close"></i></button>
                    </div>
                    <div class="modal-body">
                        @livewire('send-message-quotation', ['quote_id' => $quote_id])
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{--para elegir elegir plantilla de cotizacion--}}
@endpush

@push('script')
    <script>
        $(document).ready(function () {
            $(".nav-item").removeClass("active");
            $("a[href$='projects']").closest("li").addClass("active");
        });

        $(document).on('click', '#send-email-quote', function (e) {
            {{-- Swal.fire({
                title: "{{ __('lang.are_you_sure') }}",
                text: "{!! __('lang.sweet_alert.you_wont_be_able_to_revert_this') !!}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{ __('lang.sweet_alert.yes_send_it') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('send-email-quote', { quoteId: {{$quote_id}} })
                    Swal.fire({
                        title: "{{ __('lang.sweet_alert.sent_it') }}",
                        text: "{{ __('lang.quote.quote_has_been_sent') }}",
                        icon: "success"
                    });
                }
            });--}}


        });

    </script>
@endpush
