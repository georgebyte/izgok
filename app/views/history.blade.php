@extends('layouts.body')

@section('content')

	<h1>Zgodovina bitk</h1>

	<?php 
	$cnt=0;
	?>
	@if(count($attackedTerritoryData) > 0)
		<?php $attackedTerritoryData = $attackedTerritoryData[0]; ?>
	@endif
	@if(count($attackedTerritoryData) == 0)
		Zgodovina bitk je prazna.
	@endif
	@foreach($quizIDs as $quizID)
		<?php 
		$date=$quizDates[$cnt];
		$solved = ($solvedQuizes[$cnt]) ? " " : " - še nerešeno";
		?>
	 	<li> Napad na naselje: 
	 		{{ $attackedTerritoryData['name'] }} ({{$attackedTerritoryData['pos_x']}},{{$attackedTerritoryData['pos_y']}})
	 		<br>
	 		<a href="quiz/show/{{$quizID}}"> Poročilo bitke - {{ $date}} {{ $solved }}</a></li>
	 	<?php $cnt++; ?>
	@endforeach

@stop