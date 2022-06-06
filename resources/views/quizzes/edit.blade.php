<x-app-layout>
	<h1>{{ __('quiz.edit') }}</h1>
	<form method="post" id="quiz-edit" action="/quizzes/{{ $quiz->id }}" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<input type="text" class="form-control" name="name" id="name" value="{{ $quiz->name }}" placeholder="{{ __('quiz.name') }}"/>
			@if ( $errors->get('name') )
				<ul class="errors">
    			@foreach ($errors->get('name') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
		</div>
		<div class="form-group">
			<textarea class="form-control" name="introtext" id="introtext" placeholder="{{ __('quiz.introtext') }}">{{ $quiz->introtext }}</textarea>
			@if ( $errors->get('introtext') )
				<ul class="errors">
    			@foreach ($errors->get('introtext') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
		</div>
		@if ( strlen($quiz->introimage) ) 
    		<div class="form-group">
    			<p><img src="{{ $quiz->introimage }}" style="width:50%;"/></p>
    			<label for="introimagedelete">
    				<input type="checkbox" class="form-control" name="introimagedelete" id="introimagedelete"/> {{ __('quiz.introimagedelete') }}
    			</label>
    		</div>
    	@endif
		<div class="form-group">
		    <label for="introimage">{{ __('quiz.newintroimage') }}</label>
			<input type="file" class="form-control" name="introimage" id="introimage" />
			@if ( $errors->get('introimage') )
				<ul class="errors">
    			@foreach ($errors->get('introimage') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
		</div>
		<div class="form-group">
			<textarea class="form-control" name="outrotext" id="outrotext" placeholder="{{ __('quiz.outrotext') }}">{{ $quiz->outrotext }}</textarea>
			@if ( $errors->get('outrotext') )
				<ul class="errors">
    			@foreach ($errors->get('outrotext') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
		</div>
		@if ( strlen($quiz->outroimage) )
    		<div class="form-group">
    			<p><img src="{{ $quiz->outroimage }}" style="width:50%;"/></p>
    			<label for="outroimagedelete">
    				<input type="checkbox" class="form-control" name="outroimagedelete" id="outroimagedelete"/> {{ __('quiz.outroimagedelete') }}
    			</label>
    		</div>
    	@endif
		<div class="form-group">
		    <label for="outroimage">{{ __('quiz.newoutroimage') }}</label>
			<input type="file" class="form-control" name="outroimage" id="outroimage" />
			@if ( $errors->get('outroimage') )
				<ul class="errors">
    			@foreach ($errors->get('outroimage') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
		</div>
		<div class="form-group">
			<p><button type="submit" class="btn btn-primary form-control" id="submit">{{ __('quiz.savebutton') }}</button></p>
			<p><a class="btn btn-secondary form-control" id="cancel" href="/quizzes">{{ __('quiz.cancel') }}</a></p>
		</div>
	</form>
</x-app-layout>