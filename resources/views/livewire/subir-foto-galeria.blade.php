<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <form action="" id="form-upload-file-gallery">
        <div class="form-group">
            <label for="">{{ __('lang.drag_and_drop_photos_here_or_click_to_download_to_this_project') }}</label>
            <div>
                <input id="files-to-gallery" type="file" name="files" accept="{{ implode(',', App\Models\GaleriaProyecto::getMimeTypeAllowed()) }}" multiple>
            </div>
        </div>
        @csrf
    </form>
</div>
