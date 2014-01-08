@extends('layouts.body')

@section('content')

    {{ Form::open(array('name' => 'quiz', 'url' => URL::current())) }}
	    <?php $cnt = 0;?>
	    <strong>
			<div id="quiz" class="report col-xs-6">
				time left
			</div>
		</strong>
		<br><br>
	   	@foreach($questions as $question)
			<?php
			$shuffle = $shuffles[$cnt];
			$cnt++;

			switch($shuffle)
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
				{{ Form::radio($groupName, '1') }} {{ $answer1 }}
				<br />
				{{ Form::radio($groupName, '2') }} {{ $answer2 }}
				<br />
				{{ Form::radio($groupName, '3') }} {{ $answer3 }}
				<br />
				{{ Form::radio($groupName, '4') }} {{ $answer4 }}						
			</div>
		@endforeach
		{{ Form::button('Odgovori', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
	{{ Form::close() }}
	    
	    @if($isAttacker)
	    	<?php $timeLeft = $quizOpenedAttacker - time(); ?>
	    @endif
	    @if($isDefender)
	    	<?php $timeLeft = $quizOpenedDefender  - time(); ?>
	    @endif
	    <script src="/js/countdown.js"></script>
	    <script> 
			$(document).ready(function(){
				updateTimer("quiz",{{ $timeLeft }},"false");
			});           
		</script>	
@stop