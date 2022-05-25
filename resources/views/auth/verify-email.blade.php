<x-guest-layout>
    <x-auth-card>

		<h2>{{ __('auth.verify') }}</h2>
		
        <div class="mb-4 text-sm text-gray-600">
        	{{ __('auth.verifytext') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
            	{{ __('auth.linksent') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">
                        {{ __('auth.resent') }}
                    </button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="btn btn-default">
                    {{ __('auth.logout') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
