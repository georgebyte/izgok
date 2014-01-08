@extends('layouts.body')

@section('content')

	<div class="profile">
		
		<?php
		$avgAttackScore=number_format($aas,1);
		$avgDefenseScore=number_format($ads,1);
		?>
		<div style="padding:20px; background-color:#eeeeee; border-radius:20px; border-collapse:separate">
			<h3>{{ $na }}</h3>
			<strong>Profilna slika:</strong><br>
			<img src='{{asset($im)}}' alt='user image' width='200' height='200'>
			
			</br><br/>
			<strong>Statistika:</strong><br>
			Število rešenih kvizov: <strong>{{ $qc }}</strong> <br/>
			Največ pravilno odgovorjenih vprašanj v napadu: <strong>{{ $hsa }}</strong> <br/>
			Največ pravilno odgovorjenih vprašanj v obrambi: <strong>{{ $hsd }}</strong> <br/>
			Povprečno število pravilno odgovorjenih vprašanj v napadu: <strong>{{ $avgAttackScore }}</strong> <br/>
			Povprečno število pravilno odgovorjenih vprašanj v obrambi: <strong>{{ $avgDefenseScore }}</strong> <br/><br>
		</div>
		<br>
		<div style="padding:20px; background-color:#eeeeee; border-radius:20px; border-collapse:separate">
			@if($tc == 0)
				Ta igralec nima nobenega ozemlja
			@else
				Ta igralec ima {{ $tc }}
				@if($tc == 1)
					ozemlje
				@endif
				@if($tc == 2)
					ozemlji
				@endif
				@if($tc == 3 || $tc == 4)
					ozemlja
				@endif
				@if($tc > 4)
					ozemelj
				@endif
			@endif
			<br/><br/>
			<div style="padding-left:15px">
				@foreach($t as $val)
					<li>Ime: {{ $val['name'] }} <a href="/map/territory/{{ $val['id'] }}/{{ $val['pos_x'] }}/{{ $val['pos_y'] }}"> Link </a><br/>
				 		&nbsp;&nbsp;&nbsp;Opis: {{ $val['description'] }} <br/>
				 		&nbsp;&nbsp;&nbsp;koordinate: {{ $val['pos_x']}}, {{ $val['pos_y'] }} <br>
				 		&nbsp;&nbsp;&nbsp;<a href="/map/show/{{ $val['pos_x'] }}/{{ $val['pos_y'] }}">Pojdi na mapo</a>
				 		&nbsp;&nbsp;&nbsp;<a href="/profile/edit/{{ $val['id'] }}">Uredi</a>
				 		<hr>
					</li>
				@endforeach
			</div>
		</div>
	</div>
@stop