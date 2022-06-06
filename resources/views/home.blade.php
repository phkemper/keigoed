<x-guest-layout>

	<form action="/" method="post">
		@csrf
		@if ( $errors->get('msg') )
			<ul class="errors">
			@foreach ($errors->get('msg') as $message)
    			<li>{{ $message }}</li>
			@endforeach
			</ul>
		@endif
		<div class="form-group">
			<label for="nickname">{{ __('player.nickname') }}</label>
			<input type="text" class="form-control" id="nickname" name="nickname" autofocus>
    		@if ( $errors->get('nickname') )
    			<ul class="errors">
    			@foreach ($errors->get('nickname') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
		</div>
		<div class="form-group">
			<label for="pin">{{ __('player.enterpin') }}</label>
			<input type="text" class="form-control" id="pin" name="pin" maxlength="6" placeholder="------" autofocus>
    		@if ( $errors->get('pin') )
    			<ul class="errors">
    			@foreach ($errors->get('pin') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
			<small id="emailHelp" class="form-text text-muted">{{ __('player.getpin') }}</small>
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit" id="pinsubmit" disabled="disabled">{{ __('player.play') }}</button>
		</div>
	</form>

</x-guest-layout>
