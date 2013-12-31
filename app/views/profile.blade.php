@extends('layouts.body')

@section('content')

	
	{{ Form::open(array(
        'url'   => 'profile',
        'class' => 'search-form'
    )) }}

        <div class="form-components">
        {{ Form::text('find', '', array(
                'class'       => 'form-control',
                'placeholder' => 'Poišči igralca'
        )) }}
 		</div>
            
        <div class="form-components">
        {{ Form::button('Poišči', array(
            'type'  => 'submit',
            'class' => 'btn btn-primary'
        )) }}
        </div>

    {{ Form::close() }}



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
		@foreach($t as $t)
			<li>Ime: {{ $t['name'] }} <br/>
		 		Opis: {{ $t['description'] }} <br/>
		 		koordinate: {{ $t['pos_x']}}, {{ $t['pos_y'] }} <br>
		 		<hr>
			</li>
		@endforeach
		</div>
	</div>




@stop