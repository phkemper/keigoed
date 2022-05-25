<x-app-layout>
	<h1>{{ __('quiz.add') }}</h1>
	<form method="post" id="quiz-create" action="/quizzes" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<input type="text" class="form-control" name="name" id="name" :value="old('name')" placeholder="{{ __('quiz.name') }}"/>
			@if ( $errors->get('name') )
				<ul class="errors">
    			@foreach ($errors->get('name') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
		</div>
		<div class="form-group">
			<textarea class="form-control" name="introtext" id="introtext" placeholder="{{ __('quiz.introtext') }}">{{ old('introtext') }}</textarea>
		</div>
		<div class="form-group">
		    <label for="introimage">{{ __('quiz.introimage') }}</label>
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
			<textarea class="form-control" name="outrotext" id="outrotext" placeholder="{{ __('quiz.outrotext') }}">{{ old('outrotext') }}</textarea>
		</div>
		<div class="form-group">
		    <label for="introimage">{{ __('quiz.outroimage') }}</label>
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
			<p><button type="submit" class="btn btn-primary form-control" id="submit">{{ __('quiz.createbutton') }}</button></p>
			<p><a class="btn btn-secondary form-control" id="cancel" href="/quizzes">{{ __('quiz.cancel') }}</a></p>
		</div>
	</form>
</x-app-layout>