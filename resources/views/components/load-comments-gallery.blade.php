<div class="h-100 overflow-auto" tabindex="0">
    <div class="lg-comment-header">
        <h3 class="lg-comment-title">{{ __('lang.add_comment') }}</h3>
        <span id="close-comment-gallery" class="lg-comment-close lg-icon"></span>
    </div>
    <div class="lg-comment-body mg-t-7">
        <div class="row row-sm">
            @auth
                <div id="wrap-send-comment" class="col-xl-12 col-lg-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="text-wrap">
                                <div class="form-group">
                                    <textarea maxlength="500" id="gallery-comment" class="form-control" name="example-textarea-input" rows="6"
                                              placeholder="{{ __('lang.write_comment') }}"></textarea>
                                </div>
                                <button id="send-comment-gallery" class="btn btn-primary"><i class="fas fa-send"></i> {{ __('lang.send') }}</button>
                                @csrf
                            </div>
                        </div>
                    </div>
                </div>
            @endauth

            <div class="col-xl-12 col-lg-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div>
                            <h6 class="main-content-label mb-3">{{ __('lang.comments') }}</h6>
                        </div>

                        @forelse($comments as $comment)
                            <div class="text-wrap {{ !$loop->first ? 'mt-2' : '' }}">
                                <div class="example">
                                    <div class="d-sm-flex comment-section">
                                        <div class="media-body text-start">
                                            <h5 class="mt-0 mb-1 font-weight-semibold">{{ $comment->usuario->getCompleteName() }}
                                                <span class="tx-14 ms-0"><i
                                                        class="fe fe-check-circle text-success tx-12"></i></span>
                                                <span class="tx-12 text-muted ms-2"> {{ $comment->getDateComment() }}</span>
                                            </h5>
                                            <p class="font-13  mb-2 mt-2">
                                                {{ $comment->comentario }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>{{ __('lang.empty') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
