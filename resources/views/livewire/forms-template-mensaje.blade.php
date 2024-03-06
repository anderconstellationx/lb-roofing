<form id="form-add-template-message" method="post" wire:submit.prevent="createTemplateMessage" wire:name="createTemplateMessage">
    <div class="form-group">
        <label for="name">{{__('lang.name')}}</label>
        <input class="form-control" id="name" type="text" name="name" wire:model.live="name" value="{{ $name }}" required>
    </div>
    <div class="form-group" wire:ignore>
        <label for="content">{{__('lang.content')}}</label>
        <textarea class="form-control" id="content" wire:model="content" required>{{ $content }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">
        <i class="fa-solid fa-check"></i>
        {{ __('lang.save') }}
    </button>
</form>
@push('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                language: 'eng',
            })
            .then(function (editor) {
                editor.setData(decodeEntities('{{ $content }}'));
                editor.model.document.on('change:data', () => {
                @this.set('content', editor.getData())
                })
            })
            .catch(error => {
                console.error(error);
            });
        function decodeEntities(encodedString) {
            var textArea = document.createElement('textarea');
            textArea.innerHTML = encodedString;
            return textArea.value;
        }
    </script>
@endpush
