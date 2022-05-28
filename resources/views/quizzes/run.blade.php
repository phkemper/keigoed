<x-app-layout>
	<h1>{{ __('quiz.started') }}</h1>
	<p>{{ __('quiz.startmessage') }}</p>
	<p id="pin">{{ $quiz->pin }}</p>
	<form method="post" id="quiz-edit" action="/quizzes/{{ $quiz->id }}" enctype="multipart/form-data">
		@csrf
	</form>
</x-app-layout>