<div class="">
    <form id="newProjectStatus" method="post" wire:submit.prevent="guardar" wire:name="newProjectStatus">
        <div class="row row-sm">
            <div class="">
                <div class="form-group">
                    <p class="mg-b-10">{{ __('lang.name') }}</p>
                    <input type="text" id="nombre" class="form-control" wire:model.live='nombre'>
                    <div>@error('nombre') <span class="text-danger">{{ $message }}</span> @enderror</div>
                </div>
                <div class="form-group">
                    <p class="mg-b-10">{{ __('lang.color') }}</p>
                    <input type="color" id="color" class="form-control" wire:model='color'>
                </div>
                <div class="form-group">
                    <p class="mg-b-10">{{ __('lang.description') }}</p>
                    <textarea type="text" id="descripcion" class="form-control"
                              wire:model.live='descripcion'> </textarea>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <button data-modal-hide="newNuevoProducto" type="submit" class="btn btn-primary"><i
                    class="fas fa-save"></i> {{__('lang.save')}}</button>
            <button data-modal-hide="newNuevoProducto" type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    aria-label="Close"><i class="fas fa-close"></i> {{__('lang.cancel')}}</button>
        </div>
    </form>
</div>
