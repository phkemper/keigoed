<x-app-layout>
	<h1>{{ __('question.add') }}</h1>
	<form method="post" id="question-create" action="/quizzes/{{ $quiz->id }}/questions" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<textarea class="form-control" name="questiontext" id="questiontext" placeholder="{{ __('question.questiontext') }}" autofocus>{{ old('questiontext') }}</textarea>
		</div>
		<div class="form-group">
		    <label for="questionimage">{{ __('question.questionimage') }}</label>
			<input type="file" class="form-control" name="questionimage" id="questionimage" />
			@if ( $errors->get('questionimage') )
				<ul class="errors">
    			@foreach ($errors->get('questionimage') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
		</div>
		<div class="form-group">
			<textarea class="form-control" name="explaintext" id="explaintext" placeholder="{{ __('question.explaintext') }}">{{ old('explaintext') }}</textarea>
		</div>
		<div class="form-group">
		    <label for="explainimage">{{ __('question.explainimage') }}</label>
			<input type="file" class="form-control" name="explainimage" id="explainimage" />
			@if ( $errors->get('explainimage') )
				<ul class="errors">
    			@foreach ($errors->get('explainimage') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
		</div>
		<div class="form-group">
			<p><button type="submit" class="btn btn-primary form-control" id="submit">{{ __('question.createbutton') }}</button></p>
			<p><a class="btn btn-secondary form-control" id="cancel" href="/quizzes/{{ $quiz->id }}/questions">{{ __('question.cancel') }}</a></p>
		</div>
	</form>
</x-app-layout>