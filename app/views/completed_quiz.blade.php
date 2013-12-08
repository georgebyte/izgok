@extends('layouts.body')

@section('content')

    {{ Form::open(array('url' => URL::current())) }}
    <?php $cnt=0; ?>


    	<?php 
    	$answerHistory = AnswerHistory::where('id_quiz', '=', $quizID) -> get(); 
		
		$correctAnswerArray = array("0" => "0");
		$answeredAnswerArray = array("0" => "0");
		foreach($answerHistory as $val)
		{
			array_push($correctAnswerArray, $val['correct_answer']);
			array_push($answeredAnswerArray, $val['user_answer']);
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

			@if ($answeredAnswerArray[$cnt] == 1)
			{{ Form::radio($groupName, "1", true) }} {{ $answer1 }}
			@else
			{{ Form::radio($groupName, "1") }} {{ $answer1 }}
			@endif
			@if ($answeredAnswerArray[$cnt] == $correctAnswerArray[$cnt] && $answeredAnswerArray[$cnt] == 1)
			<img src="/img/correct.png" />
			@endif
			@if ($answeredAnswerArray[$cnt] != $correctAnswerArray[$cnt] && $answeredAnswerArray[$cnt] == 1)
			<img src="/img/wrong.png" />
			@endif
			<br />

			@if ($answeredAnswerArray[$cnt] == 2)
			{{ Form::radio($groupName, "2", true)}} {{ $answer2 }}
			@else
			{{ Form::radio($groupName, "2") }} {{ $answer2 }}
			@endif
			@if ($answeredAnswerArray[$cnt] == $correctAnswerArray[$cnt] && $answeredAnswerArray[$cnt] == 2)
			<img src="/img/correct.png" />
			@endif
			@if ($answeredAnswerArray[$cnt] != $correctAnswerArray[$cnt] && $answeredAnswerArray[$cnt] == 2)
			<img src="/img/wrong.png" />
			@endif
			<br />

			@if ($answeredAnswerArray[$cnt] == 3)
			{{ Form::radio($groupName, "3", true) }} {{ $answer3 }}
			@else
			{{ Form::radio($groupName, "3") }} {{ $answer3 }}
			@endif
			@if ($answeredAnswerArray[$cnt] == $correctAnswerArray[$cnt] && $answeredAnswerArray[$cnt] == 3)
			<img src="/img/correct.png" />
			@endif
			@if ($answeredAnswerArray[$cnt] != $correctAnswerArray[$cnt] && $answeredAnswerArray[$cnt] == 3)
			<img src="/img/wrong.png" />
			@endif
			<br />

			@if ($answeredAnswerArray[$cnt] == 4)
			{{ Form::radio($groupName, "4", true) }} {{ $answer4 }}
			@else
			{{ Form::radio($groupName, "4") }} {{ $answer4 }}
			@endif
			@if ($answeredAnswerArray[$cnt] == $correctAnswerArray[$cnt] && $answeredAnswerArray[$cnt] == 4)
			<img src="/img/correct.png" />
			@endif
			@if ($answeredAnswerArray[$cnt] != $correctAnswerArray[$cnt] && $answeredAnswerArray[$cnt] == 4)
			<img src="/img/wrong.png" />
			@endif		
		</div>
	@endforeach
	{{ Form::button('Answer', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop