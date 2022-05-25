<x-guest-layout>
    <x-auth-card>

		<h2>{{ __('auth.reset') }}</h2>
		
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="form-group">

                <x-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" placeholder="{{ __('auth.email') }}" required autofocus />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input id="password" class="form-control" type="password" name="password" placeholder="{{ __('auth.password') }}" required />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="form-control"
                                    type="password"
                                    name="password_confirmation"
                                    placeholder="{{ __('auth.confirmpassword') }}" required />
            </div>

            <div class="form-group">
                <x-button class="btn btn-primary form-control">
                    {{ __('auth.setpassword') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
