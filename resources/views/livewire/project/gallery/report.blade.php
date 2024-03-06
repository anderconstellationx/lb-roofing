<div>
    {{-- Stop trying to control. --}}
    <form action="" wire:submit="saveReport">
        @csrf
        <div class="row">
            <div class="col-12">

                @if(!$showFileGenerated)
                    <div class="form-group ">
                        <label for="report-title" class="form-label">{{ __('lang.title') }}</label>
                        <input type="text" class="form-control" id="report-title" wire:model="title">
                    </div>

                    <div class="form-group ">
                        <div class="form-label">{{ __('lang.options') }}</div>
                        <div class="custom-controls-stacked">
                            @for($i = 2; $i < 5; $i++)
                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="example-radios" wire:model="numberPages" value="{{ $i }}" {{ $i == 1 ? 'checked' : '' }}>
                                    <span class="custom-control-label">{{ __('lang.number_photos_per_page', ['number' => $i]) }}</span>
                                </label>
                            @endfor
                        </div>
                    </div>
                @endif

                @if($showFileGenerated)
                    <div class="form-group text-center">
                        <a href="mailto:{{ $to }}?subject={{ $subject }}&body={{ $message }}">
                            <button type="button" class="btn btn-primary my-2 btn-icon-text">
                                <i class="fe fe-send me-2"></i> {{ __('lang.send_email') }}
                            </button>
                        </a>

                        <a target="_blank" href="{{ url($nameFile) }}">
                            <button type="button" class="btn btn-primary my-2 btn-icon-text">
                                <i class="fe fe-eye me-2"></i> {{ __('lang.show_report') }}
                            </button>
                        </a>

                        <button type="button" wire:click="downloadReport" class="btn btn-primary my-2 btn-icon-text">
                            <i class="fe fe-download-cloud me-2"></i> {{ __('lang.download_report') }}
                        </button>
                    </div>
                @endif
            </div>
        </div>
        @if(!$showFileGenerated)
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fa-regular fa-file-pdf"></i> {{ __('lang.generate') }}</button>
                </div>
            </div>
        @endif
    </form>
</div>
