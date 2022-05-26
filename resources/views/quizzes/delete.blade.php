<x-app-layout>
	<h1>{{ __('quiz.delete') }}</h1>
	<form method="post" id="quiz-delete" action="/quizzes/{{ $quiz->id }}/delete">
		@csrf
		<p>{{ __('quiz.deletesure') }}</p>
		<p><strong>{{ $quiz->name }}</strong></p>
		<div class="form-group">
			<p><button type="submit" class="btn btn-danger form-control" id="submit">{{ __('quiz.deletebutton') }}</button></p>
			<p><a class="btn btn-secondary form-control" id="cancel" href="/quizzes">{{ __('quiz.cancel') }}</a></p>
		</div>
	</form>
</x-app-layout>