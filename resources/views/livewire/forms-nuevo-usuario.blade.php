@php
    $url = request()->url();
    $estaEnProjects = Str::contains($url, 'projects');
@endphp
<div class="NewUser">
    <form id="form-new-user" method="post" wire:submit.prevent="guardar" wire:name="newUsuario">
        <!-- Modal body -->
        <div class="p-6 space-y-6">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="nombres"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.name') }}</label>
                    <input type="text" id="nombres" class="form-control" placeholder="Jhon" wire:model='nombres'>
                    <div>@error('nombres') <span class="text-danger">{{ $message }}</span> @enderror</div>
                </div>
                <div>
                    <label for="apellidos"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.lastName') }}</label>
                    <input type="text" id="apellidos" class="form-control" placeholder="Doe"
                           wire:model='apellidos'>
                    <div>@error('apellidos') <span class="text-danger">{{ $message }}</span> @enderror</div>
                </div>
                <div>
                    <label for="email"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.email') }}</label>
                    <input type="text" id="email" class="form-control" placeholder="example@yourbestdev.com" autocomplete="off"
                           wire:model='email'>
                    <div>@error('email') <span class="text-danger">{{ $message }}</span> @enderror</div>
                </div>
                <div>
                    <label for="password"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.password') }}</label>
                    <input type="password" id="password" class="form-control" placeholder="*******" autocomplete="off"
                           wire:model='password'>
                    <div>@error('password') <span class="text-danger">{{ $message }}</span> @enderror</div>
                </div>
                <div>
                    <label for="nacimiento"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.birthDate') }}</label>
                    <input type="date" id="nacimiento" class="form-control" wire:model='nacimiento'>
                </div>
                <div>
                    <label for="telefono"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.phone') }}</label>
                    <input type="text" id="telefono" class="form-control" wire:model='telefono'>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {{-- <label for="tipo_direccion"
                                 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Tipo de direccion') }}</label>
                        <select wire:model='tipoDireccion' class="form-select" required>
                            <option value="">{{__('lang.select')}}</option>
                            @foreach(App\Models\TipoDireccion::All() as $tipo_direccion)
                            <option value="{{$tipo_direccion->id}}">{{$tipo_direccion->nombre}}</option>
                            @endforeach
                        </select>--}}
                        <label for="rol"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.role') }}</label>
                        <select wire:model='rol' name="rol" class="form-select" required>
                            <option value="">{{__('lang.select')}}</option>
                            @foreach(App\Models\Rol::All() as $rol)
                                <option value="{{$rol->id}}">{{$rol->nombre}}</option>
                            @endforeach
                        </select>
                        <div>@error('rol') <span class="text-danger">{{ $message }}</span> @enderror</div>
                    </div>
                    <div class="col-md-6">
                        <label for="documento"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.document') }}</label>
                        <input type="text" id="documento" class="form-control" wire:model='documento'>
                    </div>
                </div>
                <div>
                    <label for="direccion"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.direction') }}</label>
                    <input type="text" id="direccion" class="form-control" wire:model='direccion'>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="genero"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.genre') }}</label>
                        <select wire:model='genero' class="form-select" required>
                            <option value="">{{__('lang.select')}}</option>
                            @foreach(App\Models\Usuario::GENDER as $key => $gender)
                                <option value="{{$key}}">{{ __($gender) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('lang.status') }}</label>
                        <select wire:model='estado' class="form-select" required>
                            <option value="">{{__('lang.select')}}</option>
                            @foreach(App\Models\Estado::All() as $estados)
                                <option value="{{$estados->id}}">{{$estados->nombre}}</option>
                            @endforeach
                        </select>
                        <div>@error('estado') <span class="text-danger">{{ $message }}</span> @enderror</div>
                    </div>
                </div>

            </div>
            <!-- Modal footer -->
            <div class="mt-3">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save ml-1">
                </i> {{__('lang.save')}}
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-close"></i> {{__('lang.cancel')}}
                </button>
            </div>
        </div>
    </form>
</div>
