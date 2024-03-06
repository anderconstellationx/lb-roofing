<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new #[Layout('new-template.auth.login')] class extends Component {
    #[Rule(['required', 'string', 'email'])]
    public string $email = '';

    #[Rule(['required', 'string'])]
    public string $password = '';

    #[Rule(['boolean'])]
    public bool $remember = false;

    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (!auth()->attempt($this->only(['email', 'password'], $this->remember))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        session()->regenerate();

        if (auth()->user()->accessAllowed()) {
            $this->redirect(
                session('url.intended', RouteServiceProvider::HOME)
            );
        }else{
            $this->redirect(route('projects'));
        }
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}; ?>

<div class="col-md-12">
    <div class="card">
        <div class="row row-sm">
            <div class="text-center col-lg-6 col-xl-5 d-none d-lg-block bg-primary details">
                <div class="pos-absolute">
                    <img src="{{ asset('assets/img/logo/LB-Roofing-LLC.png') }}" class="mb-4 header-brand-img"
                         style="width: 70%" alt="logo">
                </div>
            </div>
            <div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form ">
                <div class="main-container container-fluid">
                    <div class="row row-sm">
                        <div class="mt-2 mb-2 card-body">
                            <img src="{{ asset('assets/img/logo/LB-Roofing-LLC.png') }}"
                                 class="mb-4 d-lg-none header-brand-img text-start float-start error-logo-light"
                                 alt="logo">
                            <div class="clearfix"></div>
                            <form wire:submit="login">
                                <h5 class="mb-2 text-start">{{__('lang.welcomeRoofing')}}</h5>
                                <x-auth-session-status class="mb-4" :status="session('status')"/>
                                <div class="form-group text-start">
                                    <label>{{__('lang.email')}}</label>
                                    <input class="form-control" wire:model='email' placeholder="Type Email" type="text"
                                           autocomplete="username">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                                </div>
                                <div class="form-group text-start">
                                    <label>{{__('lang.password')}}</label>
                                    <input class="form-control" wire:model='password' placeholder="Type password"
                                           type="password" required autocomplete="current-password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                </div>
                                <button class="text-white btn btn-main-primary btn-block">{{__('lang.login')}}</button>
                            </form>
                            {{-- <div class="mt-5 text-start ms-0">
                                <div class="mb-1"><a href="forgot.php">Forgot password?</a></div>
                                <div>Don't have an account? <a href="signup.php">Register Here</a></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--
<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block w-full mt-1" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="remember" id="remember" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div>
 --}}
