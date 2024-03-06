@push('style')
    <link href="{{ asset('assets/plugins/summernote/css/summernote.0.8.18.min.css') }}" rel="stylesheet">
@endpush

<form id="send-message" method="post" wire:submit.prevent="sendMessageQuoting">
    <div class="form-group">
        <label for="selectTemplate">{{ __('lang.quote.selectMessage') }}</label>
        <select aria-label="{{ __('lang.quote.selectMessage') }}"
                id="selectTemplate"
                class="form-control"
                name="selectTemplate"
                wire:model.live="selectTemplate"
                wire:change="selectTemplateUpdate"
        >
            <option value=""> {{ __('lang.choose') }} </option
            @foreach($templates as $item)
                <option value="{{ $item['id'] }}"> {{ $item['name'] }} </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="title">{{ __('lang.subject') }}</label>
        <input type="text" class="form-control" id="title" name="title" wire:model="title" value="{{ $title }}" required>
    </div>
    <div class="form-group" wire:ignore>
        <label for="message-editor">{{ __('lang.message') }}</label>
        <textarea name="message" class="form-control"
                  id="summernote"
                  wire:model="message"
                  required>
        </textarea>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-close"></i> {{ __('lang.close') }}</button>
        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"><i class="fas fa-send"></i> {{ __('lang.send') }}</button>
    </div>
</form>
@push('script')
    <script src="{{ asset('assets/plugins/summernote/summernote.0.8.18.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol']],
                ]
            });
        });

        document.addEventListener('livewire:init', () => {
            Livewire.on('update-summernote', event => {
                $('#summernote').summernote('code', event.message);
            });
        })
    </script>
@endpush
