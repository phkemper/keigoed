<x-app-layout>
	<h1>{{ __('question.delete') }}</h1>
	<form method="post" id="question-delete" action="/quizzes/{{ $quiz->id }}/questions/{{ $question->id }}/delete">
		@csrf
		<p>{{ __('question.deletesure') }}</p>
		<p><strong>{{ $question->questiontext }}</strong></p>
		<div class="form-group">
			<p><button type="submit" class="btn btn-danger form-control" id="submit">{{ __('question.deletebutton') }}</button></p>
			<p><a class="btn btn-secondary form-control" id="cancel" href="/quizzes/{{ $quiz->id }}/questions#question-{{ $question->id }}">{{ __('question.cancel') }}</a></p>
		</div>
	</form>
</x-app-layout>