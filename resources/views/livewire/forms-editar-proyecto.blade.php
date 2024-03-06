<form id="EditProject" method="post" wire:submit.prevent="actualizar" wire:name="EditProject">
    @php
        $disabled = \App\Models\Usuario::isClient() ? 'disabled' : '';
    @endphp
        <!-- Modal body -->
    <div class="p-6 space-y-6">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div class="form-group">
                <label for="titulo"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.title') }}</label>
                <input type="text" id="titulo" class="form-control" placeholder="" wire:model.live='titulo'
                       value="{{ $proyecto->titulo }}" {!! $disabled !!}>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="fechaInicio"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.startDate') }}</label>
                    <input type="date" id="fechaInicio" class="form-control" wire:model.live='fechaInicio'
                           value="{{ $proyecto->fecha_inicio }}" {!! $disabled !!}>
                </div>
                <div class="col-md-6 form-group">
                    <label for="fechaFin"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.endDate') }}</label>
                    <input type="date" id="fechaFin" class="form-control" wire:model.live='fechaFin'
                           value="{{ $proyecto->fecha_fin }}" {!! $disabled !!}>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="countries_id">{{ __('lang.countries') }}</label>
                    <select wire:model.live="countryId" wire:change="stateIdUpdate" class="form-select">
                        <option value="">{{__('lang.select')}}</option>
                        @foreach($this->countries as $country)
                            <option value="{{$country->id}}" @if($country->id == $countryId) selected @endif>
                                {{$country->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="stateId">{{ __('lang.states') }}</label>
                    <select wire:model.live="stateId" wire:change="citiesIdUpdated" class="form-select">
                        <option value="">{{__('lang.select')}}</option>
                        @foreach($this->states as $state)
                            <option value="{{$state->id}}" @if($state->id == $stateId) selected @endif>
                                {{$state->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="cityId">{{ __('lang.cities') }}</label>
                    <select wire:model='cityId' class="form-select">
                        <option value="">{{__('lang.select')}}</option>
                        @foreach($this->cities as $city)
                            <option value="{{$city->id}}" @if($city->id == $cityId) selected @endif>
                                {{$city->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="direccion"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.direction') }}</label>
                <input type="text" id="direccion" maxlength="500" class="form-control" placeholder=""
                       wire:model='direccion' {!! $disabled !!}>
            </div>
            <div class="form-group">
                <label for="observaciones"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.observations') }}</label>
                <textarea type="text" id="observaciones" style="resize: none;" class="form-control"
                          wire:model.live='observaciones' {!! $disabled !!} >{{ $proyecto->observaciones }}</textarea>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <label for="encargado"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.responsible') }}</label>
                    <select wire:model.live='encargado' class="form-select" required {!! $disabled !!}>
                        @foreach($encargados as $encargado)
                            <option value="{{$encargado->id}}"
                                    @if($proyecto->encargado_id == $encargado->id) selected @endif>{{$encargado->getCompleteName()}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="proyecto_estado_id"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.status') }}</label>
                    <select wire:model.live='proyectoEstadoId' class="form-select" required {!! $disabled !!}>
                        @foreach($estados as $estado)
                            <option value="{{$estado->id}}"
                                    @if($proyecto->proyecto_estado_id == $estado->id) selected @endif>{{$estado->nombre}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="clienteId"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.client') }}</label>
                    <select wire:model.live='clienteId' class="form-select" disabled>
                        @foreach($clientes as $cliente)
                            <option value="{{$cliente->id}}"
                                    @if($proyecto->cliente_id == $cliente->id) selected @endif>{{$cliente->getCompleteName()}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!-- Modal footer -->
        @if(\App\Models\Usuario::accessAllowed())
            <div class="mt-3">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{__('lang.save')}}</button>
            </div>
        @endif
    </div>
</form>
