@extends('layouts.body')

@section('content')
    {{ Form::open(array(
        'url'   => 'control',
        'class' => 'col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3',
        //za dodajanje slik uporabnikov
        'files' => true
    )) }}

        <div class="form-group @if($errors->has('oldUsername'))has-error @elseif(!$errors->has('oldUsername') && $errors->all())has-success @endif">
            {{ Form::label('oldUsername', 'Old username (required field)', array(
                'class' => 'control-label'
            )) }}
            {{ Form::text('oldUsername', '', array(
                'class'       => 'form-control',
                'placeholder' => 'Old username'
            )) }}
            {{ $up }}
        </div>

       <div class="form-group @if($errors->has('oldPassword'))has-error @endif">
            {{ Form::label('oldPassword', 'Old password (required field)', array(
                'class' => 'control-label'
            )) }}
            {{ Form::password('oldPassword', array(
                'class'       => 'form-control',
                'placeholder' => 'Password'
            )) }}
            {{ $up }}
        </div>

         <div class="form-group @if($errors->has('username'))has-error @elseif(!$errors->has('username') && $errors->all())has-success @endif">
            {{ Form::label('username', 'Change username', array(
                'class' => 'control-label'
            )) }}
            {{ Form::text('username', '', array(
                'class'       => 'form-control',
                'placeholder' => 'New username'
            )) }}
            {{ $errors->first('username', '<p class="help-block">:message</p>') }}
        </div>



        <div class="form-group @if($errors->has('password'))has-error @endif">
            {{ Form::label('password', 'Change password', array(
                'class' => 'control-label'
            )) }}
            {{ Form::password('password', array(
                'class'       => 'form-control',
                'placeholder' => 'New password'
            )) }}
            {{ $errors->first('password', '<p class="help-block">:message</p>') }}
        </div>

        <div class="form-group @if($errors->has('password'))has-error @endif">
            {{ Form::label('password_confirmation', 'New password confirmation', array(
                'class' => 'control-label'
            )) }}
            {{ Form::password('password_confirmation', array(
                'class'       => 'form-control',
                'placeholder' => 'New password confirmation'
            )) }}
        </div>
        
        <div class="form-group @if($errors->has('slika'))has-error @endif">
            {{ Form::label('slika', 'Change user image', array(
                'class' => 'control-label'
            )) }}
            {{ Form::file('slika', '', array(
                'class' => 'form-control',
            )) }}
            {{ $errors->first('slika', '<p class="help-block">:message</p>') }}
        </div>
        
       

        {{ Form::button('Change', array(
            'type'  => 'submit',
            'class' => 'btn btn-primary'
        )) }}

        {{ Form::button('Reset', array(
            'type'  => 'reset',
            'class' => 'btn btn-danger'
        )) }}

    {{ Form::close() }}
   
    
@stop