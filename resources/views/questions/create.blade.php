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
		
		<div class="form-group answer">
			<label for="answera">{{ __('question.answera') }}</label>
			<input type="text" class="form-control" id="answeratext" name="answeratext" placeholder="{{ __('question.answeratext') }}" value="{{ old('answeratext') }}"/>
		    <label for="answeraimage">{{ __('question.explainansweraimage') }}</label>
			<input type="file" class="form-control" name="answeraimage" id="answeraimage" />
			@if ( $errors->get('answeraimage') )
				<ul class="errors">
    			@foreach ($errors->get('answeraimage') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
    		<label for="answeracorrect"><input type="radio" id="answeracorrect" name="answercorrect" value="a" checked/> {{ __('question.answercorrect') }}</label>
		</div>
		<div class="form-group answer">
			<label for="answerb">{{ __('question.answerb') }}</label>
			<input type="text" class="form-control" id="answerbtext" name="answerbtext" placeholder="{{ __('question.answerbtext') }}" value="{{ old('answerbtext') }}"/>
		    <label for="answerbimage">{{ __('question.explainanswerbimage') }}</label>
			<input type="file" class="form-control" name="answerbimage" id="answerbimage" />
			@if ( $errors->get('answerbimage') )
				<ul class="errors">
    			@foreach ($errors->get('answerbimage') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
    		<label for="answerbcorrect"><input type="radio" id="answerbcorrect" name="answercorrect" value="b"/> {{ __('question.answercorrect') }}</label>
		</div>
		<div class="form-group answer">
			<label for="answerc">{{ __('question.answerc') }}</label>
			<input type="text" class="form-control" id="answerctext" name="answerctext" placeholder="{{ __('question.answerctext') }}" value="{{ old('answerctext') }}"/>
		    <label for="answercimage">{{ __('question.explainanswercimage') }}</label>
			<input type="file" class="form-control" name="answercimage" id="answercimage" />
			@if ( $errors->get('answercimage') )
				<ul class="errors">
    			@foreach ($errors->get('answercimage') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
    		<label for="answerccorrect"><input type="radio" id="answerccorrect" name="answercorrect" value="c"/> {{ __('question.answercorrect') }}</label>
		</div>
		<div class="form-group answer">
			<label for="answerd">{{ __('question.answerd') }}</label>
			<input type="text" class="form-control" id="answerdtext" name="answerdtext" placeholder="{{ __('question.answerdtext') }}" value="{{ old('answerdtext') }}"/>
		    <label for="answerdimage">{{ __('question.explainanswerdimage') }}</label>
			<input type="file" class="form-control" name="answerdimage" id="answerdimage" />
			@if ( $errors->get('answerdimage') )
				<ul class="errors">
    			@foreach ($errors->get('answerdimage') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
    		<label for="answerdcorrect"><input type="radio" id="answerdcorrect" name="answercorrect" value="d"/> {{ __('question.answercorrect') }}</label>
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