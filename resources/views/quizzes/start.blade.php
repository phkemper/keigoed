<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>

    	<div id="run-container">

    		<div id="main-area">
    			<div id="quiz">
    				@if ( !empty($quiz->introtext) )
    				  <p id="text1">{{ $quiz->introtext }}</p>
    				@endif
    				@if ( !empty($quiz->introimage) )
    				  <p id="image1"><img src="{{ $quiz->introimage }}"/></p>
    				@endif
    				<p>{{ __('quiz.join') }} <span id="pin">{{ $quiz->pin }}</span></p>
    			</div>
    			<div id="next">
                    <div id="logo">
                    	<img src="{{ asset('img/keigoed-quiz-tut-logo.svg') }}"/>
                    </div>
                    <p>
                    	<a class="btn btn-info" id="nextpage" href="/quizzes/{{ $quiz->id }}/next" title="{{ __('quiz.actionnext') }}"><i class="bi-play"></i></a>
                    	<a class="btn btn-danger" href="{{ URL::route('quizzes.stop', ['id' => $quiz->id]) }}" title="{{ __('quiz.actionstop') }}"><i class="bi-pause-fill"></i></a>
                    </p>
                    <p>{{ __('quiz.joiners') }} <span id="joiners">0</span></p>
    			</div>
    		</div>
    		
    		<div id="status">
    			<ul>
    				<li>Paul</li>
    				<li>Zwinkeltje</li>
    			</ul>
    		</div>
    		
        </div>

        <!-- Scripts -->
        <script>
        	const ROLE = 'quizmaster';
        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>

    </body>
</html>
