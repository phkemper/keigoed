<x-guest-layout>

	<form action="/" method="post">
		<div class="form-group">
			<label for="pin">{{ __('player.enterpin') }}</label>
			<input type="text" class="form-control" id="pin" maxlength="6" placeholder="------" autofocus>
			<small id="emailHelp" class="form-text text-muted">{{ __('player.getpin') }}</small>
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit" id="pinsubmit" disabled="disabled">{{ __('player.play') }}</button>
		</div>
	</form>

</x-guest-layout>
