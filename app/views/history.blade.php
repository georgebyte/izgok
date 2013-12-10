@extends('layouts.body')

@section('content')

	<h1>Zgodovina bitk</h1>

	<?php $cnt=0; ?>
	@foreach($quizIDs as $quizID)
		<?php 
		$date=$quizDates[$cnt];
		$solved = ($solvedQuizes[$cnt]) ? " " : " - še nerešeno";
		?>
	 	<li> <a href="quiz/show/{{$quizID}}"> Poročilo bitke - {{ $date}} {{ $solved }}</a></li>
	 	<?php $cnt++; ?>
	@endforeach

@stop