@extends('layouts.body')

@section('content')
    <h1>Admin Panel - User Form</h1>
    <?php

    	/* priprava tabele z podatki o uporabnikih - uporabljena v dropdown meniju */
    	$usersArray = array();
    	foreach($userList as $user){
    		$uId = $user['id'];
    		$uName = $user['username'];
    		$usersArray[$uId]=$uName;

    	}
    ?>
    <div class="form-group">
    	<br>
		{{ Form::open(array('url' => URL::current())) }}
		{{ Form::label('userid', 'User:') }}&nbsp;
		{{ Form::select('userid', $usersArray)}}
		<br>
		{{ Form::button('Edit', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
	{{ Form::close() }}
    </div>
@stop
