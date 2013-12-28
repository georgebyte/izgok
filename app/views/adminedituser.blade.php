@extends('layouts.body')

@section('content')
    <h1>Admin Panel - User Form</h1>
            <?php
            if(isset($userData))
            {
        		$uId = $userData['id'];
        		$uName = $userData['username'];
                $uEmail = $userData['email'];
            } ?>
            @if(isset($userData))
                <div class="form-group">
                    <br>
                    {{ Form::open(array('name' => 'edit','url' => 'edit')) }}
                        {{ Form::hidden('userid', $uId) }}
                        {{ Form::label('username', 'Username:') }}&nbsp;
                        {{ Form::text('username', $uName) }}
                        <br>
                        {{ Form::label('email', 'Email:') }}&nbsp;
                        {{ Form::text('email', $uEmail) }}
                        <br>
                        {{ Form::button('Edit', array('name' => 'edit', 'type' => 'submit', 'class' => 'btn btn-primary')) }}
                   {{ Form::close() }}
                </div>
            @else
                <h4>User is edited.</h4>
                <a href={{ URL::previous() }}>Go back</a>
            @endif
@stop
