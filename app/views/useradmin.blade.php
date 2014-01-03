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
    <div id='ShowUsers'><br /></div>
<script>
$(document).ready(function(){
    $('#username').keyup(function() {
        $('#ShowUsers').load('/api/lookup/' + $('#username').val());
    });
}); 
</script>    
@stop