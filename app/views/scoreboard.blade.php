@extends('layouts.body')

@section('content')

	<?php 
		$cnt=0;
		
	?>
	<h1>Lestvica igralcev</h1><br/><br/>
	<div style="padding:20px; background-color:#eeeeee; border-radius:25px; border-collapse:separate">
	<table>
	@foreach($scores as $nameAndImage => $score)
		<?php 
		$array=explode(" ", $nameAndImage);
		?>
			<tr>
				
				<td>
					<a href='/profile/show/{{ $array[0] }}'>
						<img src='{{asset($array[1])}}' alt='user image' width='50' height='60' style="padding-bottom:10px">
					</a>
				</td>
				<td>
					<a href='/profile/show/{{ $array[0] }}'>
						<p style="padding-bottom:10px; padding-left:30px; color:#333333; font-size:250%">{{$array[0]}}</p>
					</a>
				</td>
				<td>
					<p style="padding-bottom:10px; padding-left:30px; color:#333333; font-size:250%">{{$score}} točk</p>
				</td>
			</tr>
		
	@endforeach
	</table>
	</div>




@stop