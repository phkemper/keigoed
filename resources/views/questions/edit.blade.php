<x-app-layout>
	<h1>{{ __('question.edit') }}</h1>
	<form method="post" id="question-edit" action="/quizzes/{{ $quiz->id }}/questions/{{ $question->id }}" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<textarea class="form-control" name="questiontext" id="questiontext" placeholder="{{ __('question.questiontext') }}">{{ $question->questiontext }}</textarea>
		</div>
		@if ( strlen($question->questionimage) ) 
    		<div class="form-group">
    			<p><img src="{{ $question->questionimage }}" style="width:50%;"/></p>
    			<label for="questionimagedelete">
    				<input type="checkbox" style="form-control" name="questionimagedelete" id="questionimagedelete"/> {{ __('question.questionimagedelete') }}
    			</label>
    		</div>
    	@endif
		<div class="form-group">
		    <label for="questionimage">{{ __('question.newquestionimage') }}</label>
			<input type="file" class="form-control" name="questionimage" id="questonimage" />
			@if ( $errors->get('questionimage') )
				<ul class="errors">
    			@foreach ($errors->get('questinoimage') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
		</div>
		<div class="form-group">
			<textarea class="form-control" name="explaintext" id="explaintext" placeholder="{{ __('question.explaintext') }}">{{ $question->explaintext }}</textarea>
		</div>
		@if ( strlen($question->explainimage) )
    		<div class="form-group">
    			<p><img src="{{ $question->explainimage }}" style="width:50%;"/></p>
    			<label for="explainimagedelete">
    				<input type="checkbox" style="form-control" name="explainimagedelete" id="explainimagedelete"/> {{ __('question.explainimagedelete') }}
    			</label>
    		</div>
    	@endif
		<div class="form-group">
		    <label for="explainimage">{{ __('question.newexplainimage') }}</label>
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
			<p><button type="submit" class="btn btn-primary form-control" id="submit">{{ __('question.savebutton') }}</button></p>
			<p><a class="btn btn-secondary form-control" id="cancel" href="/quizzes/{{ $quiz->id }}/questions">{{ __('question.cancel') }}</a></p>
		</div>
	</form>
</x-app-layout>