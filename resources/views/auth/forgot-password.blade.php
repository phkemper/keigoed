<x-guest-layout>
    <x-auth-card>
    	<h2>{{ __('auth.forgottitle') }}</h2>
    	
        <div>
            {{ __('auth.forgottext') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="{{ __('auth.email') }}" required autofocus />
            </div>

            <div class="form-group">
                <button class="btn btn-primary form-control" type="submit">{{ __('auth.sendresetlink') }}</button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
