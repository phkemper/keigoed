<nav>
  @if(!Auth::check())
  	@if(!Request::is('/'))
  		<a class="btn btn-outline-light btn-sm" href="/">{{ __('auth.home') }}</a>
  	@endif
  	@if(!Request::is('login'))
  		<a class="btn btn-outline-light btn-sm" href="/login">{{ __('auth.login') }}</a>
  	@endif
  	@if(!Request::is('register'))
  		<a class="btn btn-outline-light btn-sm" href="/register">{{ __('auth.register') }}</a>
  	@endif
  @else
  	@if(!Request::is('/'))
  		<a class="btn btn-outline-light btn-sm" href="/">{{ __('auth.home') }}</a>
  	@endif
  	@if(!Request::is('dashboard') && !Request::is('quizzes'))
  		<a class="btn btn-outline-light btn-sm" href="/quizzes">{{ __('quiz.quizzes') }}</a>
  	@endif
  	<form style="display:inline" action="{{ route('logout') }}" method="post">
       @csrf
       <button class="btn btn-outline-light btn-sm" type="submit">Logout</button>
	</form>
	</div>
  @endif
</nav>
