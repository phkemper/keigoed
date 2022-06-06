<x-app-layout>
	<h1>{{ __('question.edit') }}</h1>
	<form method="post" id="question-edit" action="/quizzes/{{ $quiz->id }}/questions/{{ $question->id }}" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<textarea class="form-control" name="questiontext" id="questiontext" placeholder="{{ __('question.questiontext') }}" autofocus>{{ $question->questiontext }}</textarea>
			@if ( $errors->get('questiontext') )
				<ul class="errors">
    			@foreach ($errors->get('questiontext') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
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
			<input type="hidden" name="answeraid" value="{{ $answers[0]->id }}"/>
			<label for="answera">{{ __('question.answera') }}</label>
			<input type="text" class="form-control" id="answeratext" name="answeratext" placeholder="{{ __('question.answeratext') }}" value="{{ $answers[0]->answertext }}"/>
			@if ( strlen($answers[0]->answerimage) ) 
    		<div class="form-group">
    			<p><img src="{{ $answers[0]->answerimage }}" style="width:50%;"/></p>
    			<label for="answeraimagedelete">
    				<input type="checkbox" class="form-control" name="answeraimagedelete" id="answeraimagedelete"/> {{ __('question.questionimagedelete') }}
    			</label>
    		</div>
    		@endif
		    <label for="answeraimage">{{ __('question.explainansweraimage') }}</label>
			<input type="file" class="form-control" name="answeraimage" id="answeraimage" />
			@if ( $errors->get('answeraimage') )
				<ul class="errors">
    			@foreach ($errors->get('answeraimage') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
    		<label for="answeracorrect"><input type="radio" id="answeracorrect" name="answercorrect" value="a" {{ $answers[0]->correct ? 'checked' : '' }}/> {{ __('question.answercorrect') }}</label>
		</div>
		<div class="form-group answer">
			<input type="hidden" name="answerbid" value="{{ $answers[1]->id }}"/>
			<label for="answerb">{{ __('question.answera') }}</label>
			<input type="text" class="form-control" id="answerbtext" name="answerbtext" placeholder="{{ __('question.answerbtext') }}" value="{{ $answers[1]->answertext }}"/>
			@if ( strlen($answers[1]->answerimage) ) 
    		<div class="form-group">
    			<p><img src="{{ $answers[1]->answerimage }}" style="width:50%;"/></p>
    			<label for="answerbimagedelete">
    				<input type="checkbox" class="form-control" name="answerbimagedelete" id="answerbimagedelete"/> {{ __('question.questionimagedelete') }}
    			</label>
    		</div>
    		@endif
		    <label for="answerbimage">{{ __('question.explainanswerbimage') }}</label>
			<input type="file" class="form-control" name="answerbimage" id="answerbimage" />
			@if ( $errors->get('answerbimage') )
				<ul class="errors">
    			@foreach ($errors->get('answerbimage') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
    		<label for="answerbcorrect"><input type="radio" id="answerbcorrect" name="answercorrect" value="b" {{ $answers[1]->correct ? 'checked' : '' }}/> {{ __('question.answercorrect') }}</label>
		</div>
		<div class="form-group answer">
			<input type="hidden" name="answercid" value="{{ empty($answers[2]) ? '' : $answers[2]->id }}"/>
			<label for="answerc">{{ __('question.answerc') }}</label>
			<input type="text" class="form-control" id="answerctext" name="answerctext" placeholder="{{ __('question.answerctext') }}" value="{{ empty($answers[2]) ? '' : $answers[2]->answertext }}"/>
			@if ( !empty($answers[2]) && strlen($answers[2]->answerimage) ) 
    		<div class="form-group">
    			<p><img src="{{ $answers[2]->answerimage }}" style="width:50%;"/></p>
    			<label for="answercimagedelete">
    				<input type="checkbox" class="form-control" name="answercimagedelete" id="answercimagedelete"/> {{ __('question.questionimagedelete') }}
    			</label>
    		</div>
    		@endif
		    <label for="answercimage">{{ __('question.explainanswercimage') }}</label>
			<input type="file" class="form-control" name="answercimage" id="answercimage" />
			@if ( $errors->get('answercimage') )
				<ul class="errors">
    			@foreach ($errors->get('answercimage') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
    		<label for="answerccorrect"><input type="radio" id="answerccorrect" name="answercorrect" value="c" {{ empty($answers[2]) ? '' : ($answers[2]->correct ? 'checked' : '') }}/> {{ __('question.answercorrect') }}</label>
		</div>
		<div class="form-group answer">
			<input type="hidden" name="answerdid" value="{{ empty($answers[3]) ? '' : $answers[3]->id }}"/>
			<label for="answerd">{{ __('question.answerd') }}</label>
			<input type="text" class="form-control" id="answerdtext" name="answerdtext" placeholder="{{ __('question.answerdtext') }}" value="{{ empty($answers[3]) ? '' : $answers[3]->answertext }}"/>
			@if ( !empty($answers[3]) && strlen($answers[3]->answerimage) ) 
    		<div class="form-group">
    			<p><img src="{{ $answers[3]->answerimage }}" style="width:50%;"/></p>
    			<label for="answerdimagedelete">
    				<input type="checkbox" class="form-control" name="answerdimagedelete" id="answerdimagedelete"/> {{ __('question.questionimagedelete') }}
    			</label>
    		</div>
    		@endif
		    <label for="answerdimage">{{ __('question.explainanswerdimage') }}</label>
			<input type="file" class="form-control" name="answerdimage" id="answerdimage" />
			@if ( $errors->get('answerdimage') )
				<ul class="errors">
    			@foreach ($errors->get('answerdimage') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
    		<label for="answerdcorrect"><input type="radio" id="answerdcorrect" name="answercorrect" value="d" {{ empty($answers[3]) ? '' : ($answers[3]->correct ? 'checked' : '') }}/> {{ __('question.answercorrect') }}</label>
		</div>
		
		<div class="form-group">
			<textarea class="form-control" name="explaintext" id="explaintext" placeholder="{{ __('question.explaintext') }}">{{ $question->explaintext }}</textarea>
			@if ( $errors->get('explaintext') )
				<ul class="errors">
    			@foreach ($errors->get('explaintext') as $message)
        			<li>{{ $message }}</li>
    			@endforeach
    			</ul>
    		@endif
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
			<p><a class="btn btn-secondary form-control" id="cancel" href="/quizzes/{{ $quiz->id }}/questions#question-{{ $question->id }}">{{ __('question.cancel') }}</a></p>
		</div>
	</form>
</x-app-layout>