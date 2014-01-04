@extends('layouts.body')

@section('content')



	<div class="profile">
		<h1>Statistika</h1>
		<h3>{{ $na }}</h3>
		<?php
		$aas=number_format($aas,1);
		$ads=number_format($ads,1);
		?>
		<img src='{{asset($im)}}' alt='user image' width='200' height='200'>
		
		</br><br/>
		<strong>Število rešenih kvizov: {{ $qc }}</strong> <br/><br/>
		<strong>Največ pravilno odgovorjenih vprašanj v napadu: {{ $hsa }}</strong> <br/><br/>
		<strong>Največ pravilno odgovorjenih vprašanj v obrambi: {{ $hsd }}</strong> <br/><br/>
		<strong>Povprečno število pravilno odgovorjenih vprašanj v napadu: {{ $aas }}</strong> <br/><br/>
		<strong>Povprečno število pravilno odgovorjenih vprašanj v obrambi: {{ $ads }}</strong> <br/><br/>
		<strong>Število ozemelj: {{ $tc }}</strong> <br/><br/>
		<strong>Ozemlja:</h4><br/><br/>
		<div style="padding-left:15px">
		@foreach($t as $val)
			<li>Ime: {{ $val['name'] }} <br/>
		 		Opis: {{ $val['description'] }} <br/>
		 		koordinate: {{ $val['pos_x']}}, {{ $val['pos_y'] }} <br>
		 		&nbsp;&nbsp;<a href="/map/show/{{ $val['pos_x'] }}/{{ $val['pos_y'] }}">Pojdi na mapo</a>
		 		<hr>
			</li>
		@endforeach
		@if(count($t) == 0)
			Ta igralec nima nobenega ozemlja
		@else
			Ta igralec ima {{ count($t) }}
			@if(count($t) == 1)
				ozemlje
			@endif
			@if(count($t) == 2)
				ozemlji
			@endif
			@if(count($t) == 3 || count($t) == 4)
				ozemlja
			@endif
			@if(count($t) > 4)
				ozemelj
			@endif
		@endif
		</div>
	</div>




@stop