@extends('layouts.body')

@section('content')

	<?php 
		$cnt=0;
	?>
	{{ Form::open(array(
        'url'   => 'profile',
        'class' => 'search-form'
    )) }}

        <div class="form-components">
        {{ Form::text('find', '', array(
                'class'       => 'form-control',
                'placeholder' => 'Poišči igralca',
                'id'		  => 'username'
        )) }}
 		</div>
            
        <div class="form-components">
        {{ Form::button('Poišči', array(
            'type'  => 'submit',
            'class' => 'btn btn-primary'
        )) }}
        </div>

    {{ Form::close() }}
	<br><br><br>
	<h1>Lestvica igralcev</h1><br/>
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
	@if($start && $end)
		<a href='/scoreboard/show/{{ $page-$pageLength }}'>nazaj</a>&nbsp&nbsp
		<a href='/scoreboard/show/{{ $page+$pageLength }}'>naprej</a>
	@elseif($start)
		<a href='/scoreboard/show/{{ $page-$pageLength }}'>nazaj</a>
	@elseif($end)
		<a href='/scoreboard/show/{{ $page+$pageLength }}'>naprej</a>	
	@endif
	</div>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="/js/UserAutoComplete.js"></script>
@stop