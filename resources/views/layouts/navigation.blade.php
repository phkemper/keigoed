<nav>
  @if(!Auth::check())
  	@if(!Request::is('/'))
  		<a class="btn btn-light" href="/">{{ __('auth.home') }}</a>
  	@endif
  	@if(!Request::is('/login'))
  		<a class="btn btn-light" href="/login">{{ __('auth.login') }}</a>
  	@endif
  	@if(!Request::is('/register'))
  		<a class="btn btn-light" href="/register">{{ __('auth.register') }}</a>
  	@endif
  @endif
</nav>
