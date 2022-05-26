<x-app-layout>
	@if($errors->any())
	    <p class="error">{{$errors->first()}}</p>
    @endif
	@if (session('status'))
   	    <p class="status">{{ session('status') }}</p>
    @endif
	@if ( $quizzes )
    	<table id="quizzes">
    		<tbody>
    			@foreach ($quizzes as $quiz)
    				<tr>
    					<td class="quizactions">
    						<a class="btn btn-primary edit" href="/quizzes/{{ $quiz->id }}" title="{{ __('quiz.actionedit') }}"><i class="bi-pencil-fill"></i></a>
    						<a class="btn btn-info edit" href="/quizzes/{{ $quiz->id }}/questions" title="{{ __('quiz.actionquestions') }}"><i class="bi-question-circle"></i></a>
    						<a class="btn btn-info edit" href="/quizzes/{{ $quiz->id }}/run" title="{{ __('quiz.actionrun') }}"><i class="bi-play"></i></a>
    						<a class="btn btn-danger delete" href="/quizzes/{{ $quiz->id }}/delete" title="{{ __('quiz.actiondelete') }}"><i class="bi-trash-fill"></i></a>
    					</td>
    					<td class="quizname">{{ $quiz->name }}</td>
    				</tr>
    			@endforeach
    		</tbody>
    	</table>
    @endif
	<a id="add" class="btn btn-primary" href="/quizzes/create">{{ __('quiz.add') }}</a>
</x-app-layout>