@extends('layouts.body')

@section('content')

    {{ Form::open(array('url' => URL::current())) }}
    <?php $cnt=0; ?>
   	@foreach($questions as $question)
		<?php
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
				//base64_encode(rand(100,999)_concatenation_$rand_ID_concatenation_rand(100,999))

			$groupName="question".$cnt;
	
		?>
		<div class="form-group">
			{{ Form::label($groupName, $question['question']) }}
			<br />
			{{ Form::radio($groupName, "1") }} {{ $answer1 }}
			<br />
			{{ Form::radio($groupName, "2") }} {{ $answer2 }}
			<br />
			{{ Form::radio($groupName, "3") }} {{ $answer3 }}
			<br />
			{{ Form::radio($groupName, "4") }} {{ $answer4 }}						
		</div>
	@endforeach
	{{ Form::button('Answer', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop