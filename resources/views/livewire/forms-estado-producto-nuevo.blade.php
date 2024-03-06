<div class="NewProductStatus">
    <form id="newProductStatus" method="post" wire:submit.prevent="guardar" wire:name="newProductStatus">
        <div class="row row-sm">
            <div class="">
                <div class="form-group">
                    <p class="mg-b-10">{{ __('lang.name') }}</p>
                    <input type="text" id="nombre" class="form-control" wire:model.live='nombre'>
                </div>
                <div class="form-group">
                   <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.description') }}</label>
                    <textarea type="text" id="descripcion" class="form-control" wire:model.live='descripcion'> </textarea>
                </div>
            </div>
        </div>
        <div class="mt-3">
              <div class="mt-3">
                <button data-modal-hide="newNuevoProducto" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{__('lang.save')}}</button>
                <button data-modal-hide="newNuevoProducto" type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-close"></i> {{__('lang.cancel')}}</button>
            </div>
        </div>
    </form>
</div>
