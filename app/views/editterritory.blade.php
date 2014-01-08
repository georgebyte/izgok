@extends('layouts.body')

@section('content')

    <div class="form-group">
    	<br>
    	{{ Form::open(array('url' => 'profile/edit/')) }}
    		{{ Form::hidden('id', $territoryInfo['id'])}}

        	{{ Form::label('name', 'Ime naselja:') }}&nbsp;
            {{ Form::text('name', $territoryInfo['name'])}}<br>

            {{ Form::label('description', 'Opis naselja:') }}<br>
            {{ Form::textarea('description', $territoryInfo['description'])}}<br>

            {{ Form::button('Uredi', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
    	{{ Form::close() }}
    </div>

@stop