@push('style')
    <link href="{{ asset('assets/plugins/summernote/css/summernote.0.8.18.min.css') }}" rel="stylesheet">
@endpush

<div id="shareModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('lang.share')}}</h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="link-share-admin"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.for_admin') }}</label>
                        <div class="input-group">
                            <input class="form-control" value="{{ $link }}" type="text" readonly id="link-share-admin">
                            <span class="input-group-btn">
                        <button data-clipboard-target="#link-share-admin" class="btn ripple btn-primary copy-clipboard"
                                type="button">
                            <span class="input-group-btn">
                                <i class="fa fa-copy"></i>
                            </span>
                        </button>
                            <button class="btn  btn-primary"
                                    type="button"
                                    name="share-admin"
                                    id="share-admin"
                                    onclick="PrintPdf('{{ $link }}')"
                            >
                            <span class="input-group-btn">
                                <i class="fa fa-download"></i>
                            </span>
                        </button>

                        </span>
                        </div>
                    </div>

                    @if($linkClient)
                        <div class="form-group">
                            <label for="link-share-client"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.for_client') }}</label>
                            <div class="input-group">
                                <input class="form-control" value="{{ $linkClient }}" type="text" readonly
                                       id="link-share-client">
                                <span class="input-group-btn">
                        <button data-clipboard-target="#link-share-client" class="btn ripple btn-primary copy-clipboard"
                                type="button">
                            <span class="input-group-btn">
                                <i class="fa fa-copy"></i>
                            </span>
                        </button>
                            <button class="btn  btn-primary"
                                    type="button"
                                    name="share-client"
                                    id="share-client"
                                    onclick="PrintPdf('{{ $linkClient }}')"
                            >
                            <span class="input-group-btn">
                                <i class="fa fa-download"></i>
                            </span>
                        </button>
                    </span>
                            </div>
                        </div>
                    @endif

                </form>

                {{--<form style="margin-top: 1em" id="share-by-email" method="post" wire:submit.prevent="SendEmail"
                      wire:name="sendEmail">--}}
                <div class="form-group">
                    <label for="email"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.emails.email') }}</label>
                    <input type="text" id="email" class="form-control" value="{{ $email }}" wire:model='email'>
                </div>
                <div class="form-group">
                    <label for="subject"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.emails.subject') }}</label>
                    <input type="text" id="subject" class="form-control" value="{{ $subject }}"
                           wire:model='subject'>
                </div>

                <div class="form-group">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.link') }}</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="message-for" id="message-for-admin" wire:model="messageFor" value="1" checked>
                        <label class="form-check-label" for="message-for-admin" >
                            {{ __('lang.for_admin') }}
                        </label>
                    </div>
                    @if($linkClient)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="message-for" id="message-for-client" wire:model="messageFor" value="2">
                        <label class="form-check-label" for="message-for-client">
                            {{ __('lang.for_client') }}
                        </label>
                    </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="message"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.emails.message_body') }}</label>
                    <textarea id="share-modal-message" class="form-control"
                              wire:model='message'>{{ $message }}</textarea>
                </div>
                {{--</form>--}}
            </div>
            <div class="modal-footer">
                <button data-modal-hide="shareModal" type="button" class="btn btn-primary"
                        wire:click="sendEmail"><i class="fas fa-share"></i> {{__('lang.share_to_client')}}</button>
                <button data-modal-hide="shareModal" type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal"><i class="fas fa-cancel"></i> {{__('lang.cancel')}}</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script src="{{ asset('assets/plugins/summernote/summernote.0.8.18.min.js') }}"></script>

    <script>
        function PrintPdf(pdf) {
            var iframe = document.createElement('iframe');
            iframe.style.display = "none";
            iframe.src = pdf;
            document.body.appendChild(iframe);
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        }
    </script>
@endpush
