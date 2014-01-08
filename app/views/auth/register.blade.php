@extends('layouts.body')

@section('content')
    {{ Form::open(array(
        'url'   => 'auth/register',
        'class' => 'col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3',
        //za dodajanje slik uporabnikov
        'files' => true
    )) }}

        <div class="form-group @if($errors->has('username'))has-error @elseif(!$errors->has('username') && $errors->all())has-success @endif">
            {{ Form::label('username', 'Uporabniško ime', array(
                'class' => 'control-label'
            )) }}
            {{ Form::text('username', '', array(
                'class'       => 'form-control',
                'placeholder' => 'Uporabniško ime'
            )) }}
            {{ $errors->first('username', '<p class="help-block">:message</p>') }}
        </div>

        <div class="form-group @if($errors->has('email'))has-error @elseif(!$errors->has('email') && $errors->all())has-success @endif">
            {{ Form::label('email', 'Elektronski naslov', array(
                'class' => 'control-label'
            )) }}
            {{ Form::email('email', '', array(
                'class'       => 'form-control',
                'placeholder' => 'Elektronski naslov'
            )) }}
            {{ $errors->first('email', '<p class="help-block">:message</p>') }}
        </div>

        <div class="form-group @if($errors->has('password'))has-error @endif">
            {{ Form::label('password', 'Geslo', array(
                'class' => 'control-label'
            )) }}
            {{ Form::password('password', array(
                'class'       => 'form-control',
                'placeholder' => 'Geslo'
            )) }}
            {{ $errors->first('password', '<p class="help-block">:message</p>') }}
        </div>

        <div class="form-group @if($errors->has('password'))has-error @endif">
            {{ Form::label('password_confirmation', 'Potrdi geslo', array(
                'class' => 'control-label'
            )) }}
            {{ Form::password('password_confirmation', array(
                'class'       => 'form-control',
                'placeholder' => 'Potrdi geslo'
            )) }}
        </div>
        
        <div class="form-group @if($errors->has('slika'))has-error @endif">
            {{ Form::label('slika', 'Slika uporabnika', array(
                'class' => 'control-label'
            )) }}
            {{ Form::file('slika', '', array(
                'class' => 'form-control'
                
            )) }}
            {{ $errors->first('slika', '<p class="help-block">:message</p>') }}
        </div>
        
        <div class="form-group">
                {{ Form::label("location", "Lokacija na mapi") }}
                <br>
                {{ Form::radio("location", 'NE', true) }} NE
                &nbsp;
                {{ Form::radio("location", 'SE') }} SE
                &nbsp;
                {{ Form::radio("location", 'SW') }} SW
                &nbsp;
                {{ Form::radio("location", 'NW') }} NW
        </div>

       

        {{ Form::button('Registracija', array(
            'type'  => 'submit',
            'class' => 'btn btn-primary'
        )) }}

        {{ Form::button('Počisti', array(
            'type'  => 'reset',
            'class' => 'btn btn-danger'
        )) }}

    {{ Form::close() }}
@stop