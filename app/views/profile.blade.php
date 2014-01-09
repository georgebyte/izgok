@extends('layouts.body')

@section('content_container')
	<div class="profile-player col-md-6">
		<div class="profile-player-pic-name clearfix">
			<?php
			$avgAttackScore=number_format($aas,1);
			$avgDefenseScore=number_format($ads,1);
			?>
			<div class="profile-player-pic">
				<img src='{{asset($im)}}' class="img-thumbnail" alt='{{ $na }}'>
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
			<h3>
				@if($tc == 0)
					{{ ucfirst ($na) }} si ne lasti nobene vasi.
				@else
					{{ ucfirst ($na) }} ima v lasti <strong>{{ $tc }}</strong>
					@if($tc == 1)
						vas:
					@endif
					@if($tc == 2)
						vasi:
					@endif
					@if($tc == 3 || $tc == 4)
						vasi:
					@endif
					@if($tc > 4)
						vasi:
					@endif
				@endif
			</h3>
		</div>
		<div class="profile-villages-list">
			<table>
				@foreach($t as $val)				
					<tr>
						<td>
							<strong><a href="/map/territory/{{ $val['id'] }}/{{ $val['pos_x'] }}/{{ $val['pos_y'] }}">{{ $val['name'] }}</a> ({{ $val['pos_x']}}, {{ $val['pos_y'] }})</strong>
						</td>
						<td>
							<a href="/map/show/{{ $val['pos_x'] }}/{{ $val['pos_y'] }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-globe"></span></a>
				 			@if (Auth::user()->username == $na)
				 				<a href="/profile/edit/{{ $val['id'] }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
				 			@endif
						</td>
					</tr>
				@endforeach
			</table>		
		</div>
	</div>
@stop