<x-app-layout>
    <p class="quizname">{{ $quiz->name }}</p>
	@if($errors->any())
	    <p class="error">{{$errors->first()}}</p>
    @endif
	@if (session('status'))
   	    <p class="status">{{ session('status') }}</p>
    @endif
	@if ( $questions )
    	<div id="questions">
			@foreach ($questions as $question)
				<div class="question">
					<a name="question-{{ $question->id }}"></a>
					<div class="questiontext">{{ $question->seqnr+1 }}. {{ $question->questiontext }}</div>
					<div class="details">
    					<div class="actions">
    						<a class="btn btn-primary edit" href="/quizzes/{{ $question->quizid }}/questions/{{ $question->id }}" title="{{ __('question.actionedit') }}"><i class="bi-pencil-fill"></i></a>
    						<a class="btn btn-info up" href="/quizzes/{{ $quiz->id }}/questions/{{ $question->id }}/up" title="{{ __('question.actionup') }}"><i class="bi-arrow-up"></i></a>
    						<a class="btn btn-info down" href="/quizzes/{{ $quiz->id }}/questions/{{ $question->id }}/down" title="{{ __('question.actiondown') }}"><i class="bi-arrow-down"></i></a>
    						<a class="btn btn-danger delete" href="/quizzes/{{ $question->quizid }}/questions/{{ $question->id }}/delete" title="{{ __('question.actiondelete') }}"><i class="bi-trash-fill"></i></a>
    					</div>
					</div>
				</div>
			@endforeach
    	</div>
    @endif
	<a id="add" class="btn btn-primary" href="/quizzes/{{ $quiz->id }}/questions/create">{{ __('question.add') }}</a>
</x-app-layout>