<div class="NewCliente">
    <form id="newClienteForm" method="post" wire:submit.prevent="guardar" wire:name="newNuevoProducto">
        <div class="row row-sm">
            <div>
                <div class="form-group">
                    <label for="nombre"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.name') }}</label>
                    <input type="text" id="nombre" class="form-control"
                           wire:model.live='nombre'>
                    <div>@error('nombre') <span class="text-danger">{{ $message }}</span> @enderror</div>
                </div>
                <div class="form-group">
                    <label for="descripcion"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.description') }}</label>
                    <textarea type="text" id="descripcion" class="form-control"
                              wire:model.live='descripcion'></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="tipoMedida"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.typeMeasure') }}</label>
                    <select wire:model.live='tipoMedida' class="form-select">
                        <option value="">{{__('lang.select')}}</option>
                        @foreach(App\Models\TipoMedida::All() as $tipoMedida)
                            <option
                                value="{{$tipoMedida->id}}">{{$tipoMedida->medida . ' - ' . $tipoMedida->sufijo}}</option>
                        @endforeach
                    </select>
                    <div>@error('tipoMedida') <span class="text-danger">{{ $message }}</span> @enderror</div>
                </div>
                <div class="col-md-6">
                    <label for="unidadMedida"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.unit_of_measure') }}</label>
                    <input type="text" id="unidadMedida" class="form-control" wire:model.live='unidadMedida'>
                    <div>@error('unidadMedida') <span class="text-danger">{{ $message }}</span> @enderror</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="precioCompra"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.priceBuy') }}</label>
                    <input type="number" min="0" id="precioCompra" class="form-control" wire:model.live='precioCompra'>
                    <div>@error('precioCompra') <span class="text-danger">{{ $message }}</span> @enderror</div>
                </div>
                <div class="col-md-6">
                    <label for="precioVenta"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.priceSale') }}</label>
                    <input type="number" min="0" id="precioVenta" class="form-control" wire:model.live='precioVenta'>
                    <div>@error('precioVenta') <span class="text-danger">{{ $message }}</span> @enderror</div>
                </div>
            </div>
            <div class="form-group">
                <label for="proveedor"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.provider') }}</label>
                <select wire:model.live='proveedor' class="form-select">
                    <option value="">{{__('lang.select')}}</option>
                    @foreach(App\Models\Proveedor::All() as $proveedor)
                        <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                    @endforeach
                </select>
                <div>@error('proveedor') <span class="text-danger">{{ $message }}</span> @enderror</div>
            </div>
        {{--<div>
            <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Estado') }}</label>
            <select wire:model='estado' class="form-select" required>
                <option value="">{{__('lang.select')}}</option>
                @foreach(App\Models\EstadoProducto::All() as $estados)
                <option  value="{{$estados->id}}">{{$estados->nombre}}</option>
            @endforeach
            </select>
        </div>--}}
        </div>
        <!-- Modal footer -->
        <div class="mt-3">
            <div class="mt-3">
                <button data-modal-hide="newNuevoProducto" type="submit" class="btn btn-primary"><i
                        class="fas fa-save"></i> {{__('lang.save')}}</button>
                <button data-modal-hide="newNuevoProducto" type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-close"></i> {{__('lang.cancel')}}
                </button>
            </div>
        </div>
    </form>
</div>
