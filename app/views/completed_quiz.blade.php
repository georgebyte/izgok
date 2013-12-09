@extends('layouts.body')

@section('content')
    <?php $cnt=0; ?>


    	<?php 

    	/*
    	*  $correctAnswerArray             pravilni odgovori
    	*  $answeredAnswerArrayAttacker    tabela odgovorov napadalca
    	*  $answeredAnswerArrayDefender    tabela odgovorov branitelja
    	*/


    	/* parsanje odgovorov napadalca */
    	$answerHistory = AnswerHistory::where('id_quiz', '=', $quizID) -> where('id_attacker', '=', Auth::user() -> id) -> get(); 
		
		$correctAnswerArray = array("0" => "0");
		$answeredAnswerArrayAttacker = array("0" => "0");
		foreach($answerHistory as $val)
		{
			array_push($correctAnswerArray, $val['correct_answer']);
			array_push($answeredAnswerArrayAttacker, $val['attacker_answer']);
		}


		/* parsanje odgovorov branitelja */
		$answerHistory = AnswerHistory::where('id_quiz', '=', $quizID) -> where('id_defender', '=', $defenderID) -> get();
		$answeredAnswerArrayDefender = array("0" => "0");
		foreach($answerHistory as $val)
		{
			array_push($answeredAnswerArrayDefender, $val['attacker_answer']);
		}
		?>

   	@foreach($questions as $question)
		<?php

		
		/* pregled kviza */
		/* SHUFFLE */
		/* ce je kviz zakljucen mu ne dela shuffla */

			$rndToken=$answerTokens[$cnt];
			$cnt++;

			switch($rndToken)
			{
				case 1:
					$answer1 = $question['answer_1'];
					$answer2 = $question['answer_2'];
					$answer3 = $question['answer_3'];
					$answer4 = $question['answer_correct'];
				break;

				case 2:
					$answer2 = $question['answer_1'];
					$answer1 = $question['answer_2'];
					$answer4 = $question['answer_3'];
					$answer3 = $question['answer_correct'];
				break;

				case 3:
					$answer3 = $question['answer_1'];
					$answer4 = $question['answer_2'];
					$answer1 = $question['answer_3'];
					$answer2 = $question['answer_correct'];
				break;

				case 4:
					$answer4 = $question['answer_1'];
					$answer2 = $question['answer_2'];
					$answer3 = $question['answer_3'];
					$answer1 = $question['answer_correct'];
				break;

				case 5:
					$answer4 = $question['answer_1'];
					$answer3 = $question['answer_2'];
					$answer1 = $question['answer_3'];
					$answer2 = $question['answer_correct'];
				break;

				case 6:
					$answer2 = $question['answer_1'];
					$answer3 = $question['answer_2'];
					$answer1 = $question['answer_3'];
					$answer4 = $question['answer_correct'];
				break;

				case 7:
					$answer4 = $question['answer_1'];
					$answer2 = $question['answer_2'];
					$answer1 = $question['answer_3'];
					$answer3 = $question['answer_correct'];
				break;

				case 8:
					$answer3 = $question['answer_1'];
					$answer4 = $question['answer_2'];
					$answer2 = $question['answer_3'];
					$answer1 = $question['answer_correct'];
				break;
			}

			$groupName="question".$cnt;
	
		?>
		<div class="form-group">
			{{ Form::label($groupName, $question['question']) }}
			<br />

			@if ($answeredAnswerArrayAttacker[$cnt] == 1)
			{{ Form::radio($groupName, "1", true, array('disabled')) }} {{ $answer1 }}
			@else
			{{ Form::radio($groupName, "1", false, array('disabled')) }} {{ $answer1 }}
			@endif
			@if ($answeredAnswerArrayAttacker[$cnt] == $correctAnswerArray[$cnt] && $answeredAnswerArrayAttacker[$cnt] == 1)
			<img src="/img/correct.png" />
			@endif
			@if ($answeredAnswerArrayAttacker[$cnt] != $correctAnswerArray[$cnt] && $answeredAnswerArrayAttacker[$cnt] == 1)
			<img src="/img/wrong.png" />
			@endif
			<br />

			@if ($answeredAnswerArrayAttacker[$cnt] == 2)
			{{ Form::radio($groupName, "2", true, array('disabled'))}} {{ $answer2 }}
			@else
			{{ Form::radio($groupName, "2", false, array('disabled')) }} {{ $answer2 }}
			@endif
			@if ($answeredAnswerArrayAttacker[$cnt] == $correctAnswerArray[$cnt] && $answeredAnswerArrayAttacker[$cnt] == 2)
			<img src="/img/correct.png" />
			@endif
			@if ($answeredAnswerArrayAttacker[$cnt] != $correctAnswerArray[$cnt] && $answeredAnswerArrayAttacker[$cnt] == 2)
			<img src="/img/wrong.png" />
			@endif
			<br />

			@if ($answeredAnswerArrayAttacker[$cnt] == 3)
			{{ Form::radio($groupName, "3", true, array('disabled')) }} {{ $answer3 }}
			@else
			{{ Form::radio($groupName, "3", false, array('disabled')) }} {{ $answer3 }}
			@endif
			@if ($answeredAnswerArrayAttacker[$cnt] == $correctAnswerArray[$cnt] && $answeredAnswerArrayAttacker[$cnt] == 3)
			<img src="/img/correct.png" />
			@endif
			@if ($answeredAnswerArrayAttacker[$cnt] != $correctAnswerArray[$cnt] && $answeredAnswerArrayAttacker[$cnt] == 3)
			<img src="/img/wrong.png" />
			@endif
			<br />

			@if ($answeredAnswerArrayAttacker[$cnt] == 4)
			{{ Form::radio($groupName, "4", true, array('disabled')) }} {{ $answer4 }}
			@else
			{{ Form::radio($groupName, "4", false, array('disabled')) }} {{ $answer4 }}
			@endif
			@if ($answeredAnswerArrayAttacker[$cnt] == $correctAnswerArray[$cnt] && $answeredAnswerArrayAttacker[$cnt] == 4)
			<img src="/img/correct.png" />
			@endif
			@if ($answeredAnswerArrayAttacker[$cnt] != $correctAnswerArray[$cnt] && $answeredAnswerArrayAttacker[$cnt] == 4)
			<img src="/img/wrong.png" />
			@endif		
		</div>
	@endforeach

@stop