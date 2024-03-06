<form id="crearFactura" method="post" wire:submit.prevent="crearFactura" wire:name="crearFactura">
    <!-- Modal body -->
    <div class="p-6 space-y-6">
        <div class="row row-sm">
            <div class="form-group col-md-3">
                <label for="titulo"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.title') }}</label>
                <input type="text" id="titulo" class="form-control" wire:model.live='titulo' required>
            </div>
            <div class="form-group col-md-3">
                <label for="cliente"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.client') }}</label>
                <select class="form-control" wire:model.live='cliente' disabled>
                    <option value="{{$cliente->id}}">{{$cliente->nombres}}</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="codigoFactura"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.invoiceCode') }}</label>
                <input type="text" id="codigoFactura" class="form-control" wire:model.live='codigoFactura'
                       value="{{$codigoFactura}}" disabled>
            </div>
            <div class="form-group col-md-3">
                <label for="estadoFactura"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.status') }}</label>
                <select class="form-control" wire:model.live='estadoFactura' required>
                     @foreach($estadosFactura as $estado)
                        <option value="{{$estado->id}}"> {{$estado->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="fechaEmision"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.DateOfIssue') }}</label>
                <input type="date" id="fechaEmision" class="form-control" wire:model.live='fechaEmision'>
            </div>
            <div class="form-group col-md-6">
                <label for="fechaVencimiento"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.DateOfExpiry') }}</label>
                <input type="date" id="fechaVencimiento" class="form-control" wire:model.live='fechaVencimiento'>
            </div>
            <div class="form-group col-md-6">
                <label for="cotizacion"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.quote.quotations') }}</label>
                <select wire:model.live='cotizacion' wire:change="filtrarCotizacion()" class="form-select" required>
                    <option value="">{{__('lang.select')}}</option>
                    @foreach($cotizaciones as $cotizacion)
                        <option value="{{$cotizacion->id}}"> {{$cotizacion->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="proyecto"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.project.project') }}</label>
                <select wire:model.live='proyecto' class="form-select" required disabled>
                    <option value="{{$proyecto->id}}"> {{$proyecto->titulo}}</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="descuento"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.discount') }}</label>
                <input type="number" wire:model.live="descuento" id="descuento" class="form-control" required value="{{ $descuento }}">
            </div>
            <div class="form-group col-md-4">
                <label for="subtotal"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.subtotal') }}</label>
                <input type="number" wire:model.live="subtotal" id="subtotal" class="form-control" required value="{{ $subtotal }}">
            </div>
            <div class="form-group col-md-4">
                <label for="total"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.total') }}</label>
                <input type="number" wire:model.live="total" id="total" class="form-control" required value="{{ $total }}">
            </div>
            <div class="form-group">
                <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.observations') }}</label>
                <textarea id="observaciones" maxlength="500" class="form-control" rows="5" wire:model.live='observaciones'></textarea>
            </div>
        </div>

    </div>
    <!-- Modal footer -->
    <div class="mt-3">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{__('lang.save')}}</button>
    </div>
    </div>
</form>
