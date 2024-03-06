<div class="NewProyect">
    <form id="NewProyect" method="post" wire:submit.prevent="guardar" wire:name="NewProyect">
        <div class="form-group">
            <label for="titulo"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.title') }}</label>
            <input type="text" id="titulo" class="form-control" placeholder="Project Roofing" wire:model='titulo'>
            <div>@error('titulo') <span class="text-danger">{{ $message }}</span> @enderror</div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="fechaInicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.startDate') }}</label>
                <input type="date" id="fechaInicio" class="form-control" wire:model='fechaInicio'>
            </div>
            <div class="col-md-6">
                <label for="fechaFin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.endDate') }}</label>
                <input type="date" id="fechaFin" class="form-control" wire:model='fechaFin'>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label for="countries_id">{{ __('lang.countries') }}</label>
                <select wire:model.live="countryId" wire:change="stateIdUpdate" class="form-select">
                    <option value="">{{__('lang.select')}}</option>
                    @foreach($this->countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="stateId">{{ __('lang.states') }}</label>
                <select wire:model.live="stateId" wire:change="citiesIdUpdated" class="form-select">
                    <option value="">{{__('lang.select')}}</option>
                    @foreach($this->states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="cityId">{{ __('lang.cities') }}</label>
                <select wire:model='cityId' class="form-select">
                    <option value="">{{__('lang.select')}}</option>
                    @foreach($this->cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.direction') }}</label>
            <input type="text" id="direccion" maxlength="500" class="form-control" placeholder="" wire:model='direccion'>
            <div>@error('direccion') <span class="text-danger">{{ $message }}</span> @enderror</div>
        </div>
        <div class="form-group">
            <label for="observaciones"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.observations') }}</label>
            <textarea type="text" id="observaciones" class="form-control" wire:model='observaciones'></textarea>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="encargado"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.responsible') }}</label>
                <select wire:model='encargado' class="form-select">
                    <option value="">{{__('lang.selectResponsible')}}</option>
                    @foreach($this->encargados as $usuario)
                        <option value="{{$usuario->id}}">{{$usuario->getCompleteName()}}</option>
                    @endforeach
                </select>
                <div>@error('encargado') <span class="text-danger">{{ $message }}</span> @enderror</div>
            </div>

            <div class="col-md-6">
                {{--<label for="proyecto_estado_id"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.status') }}</label>
                <select wire:model='proyectoEstadoId' class="form-select">
                    <option value="">{{__('lang.selectStatus')}}</option>
                    @foreach($this->estados as $estado)
                    <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                    @endforeach
                </select>
                <div>@error('proyectoEstadoId') <span class="text-danger">{{ $message }}</span> @enderror</div>--}}
                <div class="form-group">
                    <label for="client">{{__('lang.client')}}</label>
                    <div class="input-group file-browser mb-3">
                        <select id="client" wire:model='clienteId' class="form-select">
                            <option value="">{{__('lang.selectClient')}}</option>
                            @foreach($this->clientes as $cliente)
                                <option value="{{$cliente->id}}">{{$cliente->getCompleteName()}}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary" data-bs-target="#NuevoCliente" data-bs-toggle="modal"
                                data-bs-dismiss="modal"><i class="fas fa-plus"></i></button>
                    </div>
                    <div>@error('clienteId') <span class="text-danger">{{ $message }}</span> @enderror</div>
                </div>
            </div>
        </div>
        <!-- Modal footer -->
        <div class="text-right">
            <button data-modal-hide="nuevoProyecto" type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{__('lang.save')}}
            </button>
            <button data-modal-hide="nuevoProyecto" type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    aria-label="Close">
                <i class="fas fa-close"></i> {{__('lang.cancel')}}
            </button>
        </div>
    </form>
</div>
