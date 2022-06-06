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

    	<div id="play-container">

			<div id="nickname">{{ __('player.hallo', ['nickname' => $nickname]) }}</div>
            <div id="logo"><img src="{{ asset('img/keigoed-quiz-tut-logo.svg') }}"/></div>
            
			<div id="quiz">
			</div>
    		
    		<div id="answers">
    			<div class="answer" id="answer-a">
    				<div class="answericon">
    					<i class="bi-triangle-fill"></i>
    				</div>
    				<div class="answertextimage">
    					<div class="answertext"><p></p></div>
    					<div class="answerimage"><img src=""/></div>
    				</div>
    			</div>
    			<div class="answer" id="answer-b">
    				<div class="answericon">
    					<i class="bi-square-fill"></i>
    				</div>
    				<div class="answertextimage">
    					<div class="answertext"><p></p></div>
    					<div class="answerimage"><img src=""/></div>
    				</div>
    			</div>
    			<div class="answer" id="answer-c">
    				<div class="answericon">
    					<i class="bi-circle-fill"></i>
    				</div>
    				<div class="answertextimage">
    					<div class="answertext"><p></p></div>
    					<div class="answerimage"><img src=""/></div>
    				</div>
    			</div>
    			<div class="answer" id="answer-d">
    				<div class="answericon">
    					<i class="bi-diamond-fill"></i>
    				</div>
    				<div class="answertextimage">
    					<div class="answertext"><p></p></div>
    					<div class="answerimage"><img src=""/></div>
    				</div>
    			</div>
    		</div>
        </div>

        <!-- Scripts -->
        <script>
        	const ROLE = 'player';
        	const STAGE = '{{ $stage }}';
        	const QUIZID = {{ $quiz->id }};
        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>

    </body>
</html>
