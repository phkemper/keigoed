<x-app-layout>
	@if ( $quizzes )
    	<table id="quizzes">
    		<tbody>
    			@foreach ($quizzes as $quiz)
    				<tr>
    					<td>{{ $quiz->name }}</td>
    					<td>
    						<a class="btn btn-primary edit" href="/quizzes/{{ $quiz->id }}">Edit</a>
    						<a class="btn btn-danger delete" href="/quizzes/{{ $quiz->id }}/delete">Delete</a>
    					</td>
    				</tr>
    			@endforeach
    		</tbody>
    	</table>
    @endif
	<a id="add" class="btn btn-primary" href="/quizzes/create">{{ __('quiz.add') }}</a>
</x-app-layout>