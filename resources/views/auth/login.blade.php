<x-guest-layout>
    <x-auth-card>

		<h2>{{ __('auth.logintitle') }}</h2>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">

                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="{{ __('auth.email') }}" required autofocus />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input id="password" class="form-control"
                                type="password"
                                name="password"
                                placeholder="{{ __('auth.password') }}"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('auth.remember') }}</span>
                </label>
            </div>

			<div class="form-group">
				<button class="btn btn-primary form-control" type="submit">{{ __('auth.login') }}</button>
			</div>
            
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('auth.forgot') }}
                    </a>
                @endif

            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
