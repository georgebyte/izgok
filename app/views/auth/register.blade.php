@extends('layouts.body')

@section('content')
    {{ Form::open(array(
        'url'   => 'auth/register',
        'class' => 'col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3'
    )) }}

        <div class="form-group @if($errors->has('username'))has-error @elseif(!$errors->has('username') && $errors->all())has-success @endif">
            {{ Form::label('username', 'Username', array(
                'class' => 'control-label'
            )) }}
            {{ Form::text('username', '', array(
                'class'       => 'form-control',
                'placeholder' => 'Username'
            )) }}
            {{ $errors->first('username', '<p class="help-block">:message</p>') }}
        </div>

        <div class="form-group @if($errors->has('email'))has-error @elseif(!$errors->has('email') && $errors->all())has-success @endif">
            {{ Form::label('email', 'Email address', array(
                'class' => 'control-label'
            )) }}
            {{ Form::email('email', '', array(
                'class'       => 'form-control',
                'placeholder' => 'Email address'
            )) }}
            {{ $errors->first('email', '<p class="help-block">:message</p>') }}
        </div>

        <div class="form-group @if($errors->has('password'))has-error @endif">
            {{ Form::label('password', 'Password', array(
                'class' => 'control-label'
            )) }}
            {{ Form::password('password', array(
                'class'       => 'form-control',
                'placeholder' => 'Password'
            )) }}
            {{ $errors->first('password', '<p class="help-block">:message</p>') }}
        </div>

        <div class="form-group @if($errors->has('password'))has-error @endif">
            {{ Form::label('password_confirmation', 'Password confirmation', array(
                'class' => 'control-label'
            )) }}
            {{ Form::password('password_confirmation', array(
                'class'       => 'form-control',
                'placeholder' => 'Password confirmation'
            )) }}
        </div>
        
        {{ Form::button('Register', array(
            'type'  => 'submit',
            'class' => 'btn btn-primary'
        )) }}

        {{ Form::button('Reset', array(
            'type'  => 'reset',
            'class' => 'btn btn-danger'
        )) }}

    {{ Form::close() }}
@stop