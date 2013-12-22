@extends('layouts.body')

@section('content')

	<h1>Statistika</h1>
	<h3>{{ $na }}</h3>
	<?php 
	$cnt=0;
	$aas=number_format($aas,1);
	$ads=number_format($ads,1);
	echo "<img src=".$im." alt='user image' width='200' height='200'>"
	?>
	</br><br/>
	<strong>Število rešenih kvizov: {{ $qc }}</strong> <br/><br/>
	<strong>Največ pravilno odgovorjenih vprašanj v napadu: {{ $hsa }}</strong> <br/><br/>
	<strong>Največ pravilno odgovorjenih vprašanj v obrambi: {{ $hsd }}</strong> <br/><br/>
	<strong>Povprečno število pravilno odgovorjenih vprašanj v napadu: {{ $aas }}</strong> <br/><br/>
	<strong>Povprečno število pravilno odgovorjenih vprašanj v obrambi: {{ $ads }}</strong> <br/><br/>
	<strong>Število ozemelj: {{ $tc }}</strong> <br/><br/>
	<strong>Ozemlja:</h4><br/><br/>
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