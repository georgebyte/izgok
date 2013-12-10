@extends('layouts.body')

@section('content')

	<h1>History</h1>

	<?php $cnt=0; ?>
	@foreach($quizIDs as $quizID)
		<?php $date=$quizDates[$cnt]; ?>
	 	<li> <a href="quiz/show/{{$quizID}}"> Battle report - {{ $date}}</a></li>
	 	<?php $cnt++; ?>
	@endforeach

@stop