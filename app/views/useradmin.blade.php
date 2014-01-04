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
    	{{ Form::open(array('url' => 'admin/user')) }}
        	{{ Form::label('userid', 'User:') }}&nbsp;
            {{ Form::select('userid', $usersArray)}}
            {{ Form::button('Edit', array('type' => 'submit', 'name' => 'dropdown', 'class' => 'btn btn-primary')) }}
            <br><br>
            {{ Form::label('username', 'User:') }}&nbsp;
            {{ Form::text('username', '', array('id' => 'username')) }}
            {{ Form::button('Edit', array('type' => 'submit', 'name' => 'searchbox', 'class' => 'btn btn-primary')) }}
    	{{ Form::close() }}
    </div>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="/js/UserAutoComplete.js"></script>
@stop