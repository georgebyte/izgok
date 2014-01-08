@extends('layouts.body')

@section('content_container')
	<div class="profile-player col-md-6">
		<div class="profile-player-pic-name clearfix">
			<?php
			$avgAttackScore=number_format($aas,1);
			$avgDefenseScore=number_format($ads,1);
			?>
			<div class="profile-player-pic">
				<img src='{{asset($im)}}' alt='{{ $na }}'>
			</div>
			<div class="profile-player-name">
				<h3>{{ $na }}</h3>
			</div>
		</div>
		<div class="profile-player-stats">
			<table class="table table-bordered">
				<tr>
					<td>
						Število rešenih kvizov
					</td>
					<td>
						{{ $qc }}
					</td>
				</tr>
				<tr>
					<td>
						Največ pravilno odgovorjenih vprašanj v napadu
					</td>
					<td>
						{{ $hsa }}
					</td>
				</tr>
				<tr>
					<td>
						Največ pravilno odgovorjenih vprašanj v obrambi
					</td>
					<td>
						{{ $hsd }}
					</td>
				</tr>
				<tr>
					<td>
						Povprečno število pravilno odgovorjenih vprašanj v napadu
					</td>
					<td>
						{{ $avgAttackScore }}
					</td>
				</tr>
				<tr>
					<td>
						Povprečno število pravilno odgovorjenih vprašanj v obrambi
					</td>
					<td>
						{{ $avgDefenseScore }}
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="profile-villages col-md-6">
		<div class="profile-villages-header">
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
		</div>
		<div class="profile-villages-list">
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
@stop