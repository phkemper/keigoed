<x-guest-layout>
    <x-auth-card>
        
        <h2>{{ __('auth.confirm') }}</h2>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('auth.secure') }}
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="form-group">
                <x-input id="password" class="form-control"
                                type="password"
                                name="password"
                                placeholder="{{ __('auth.password') }}"
                                required autocomplete="current-password" />
            </div>

            <div class="form-group">
                <button type="submit" class="form-control">
                    {{ __('auth.confirmsubmit') }}
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
