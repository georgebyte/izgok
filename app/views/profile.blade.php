@extends('layouts.body')

@section('content')

	<h1>Statistika</h1>

	<?php 
	$cnt=0;
	$aas=number_format($aas,1);
	$ads=number_format($ads,1);
	?>
	<h4>Število rešenih kvizov:</h4><p>{{ $qc }}</p>
	<h4>Največ pravilno odgovorjenih vprašanj v napadu:</h4><p>{{ $hsa }}</p>
	<h4>Največ pravilno odgovorjenih vprašanj v obrambi:</h4><p>{{ $hsd }}</p>
	<h4>Povprečno število pravilno odgovorjenih vprašanj v napadu:</h4><p>{{ $aas }}</p>
	<h4>Povprečno število pravilno odgovorjenih vprašanj v obrambi:</h4><p>{{ $ads }}</p>
	<h4>Število ozemelj:</h4><p>{{ $tc }}</p>
	<h4>Ozemlja:</h4>
	@foreach($t as $t)
		<?php 
		
		?>
		<li>Ime: {{ $t['name'] }} <br/>
	 		Opis: {{ $t['description'] }} <br/>
	 		koordinate: {{ $t['pos_x']}}, {{ $t['pos_y'] }} <br>
	 		<hr>

	 		<br>
	 	</li>
	 	<?php $cnt++; ?>
	@endforeach

@stop