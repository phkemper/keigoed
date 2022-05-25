<x-guest-layout>
    <x-auth-card>
    
    	<h2>{{ __('auth.register') }}</h2>
    	
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" placeholder="{{ __('auth.name') }}" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="{{ __('auth.email') }}" required />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input id="password" class="form-control"
                                type="password"
                                name="password"
                                placeholder="{{ __('auth.password') }}"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <x-input id="password_confirmation" class="form-control"
                                type="password"
                                name="password_confirmation"
                                placeholder="{{ __('auth.confirmpassword') }}" required />
            </div>

            <div class="form-group">
                <button class="btn btn-primary form-control">
                    {{ __('auth.register') }}
                </button>
            </div>
            
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('auth.registered') }}
                    </a>
        </form>
    </x-auth-card>
</x-guest-layout>
