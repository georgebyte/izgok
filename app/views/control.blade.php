@extends('layouts.body')

@section('content')
    {{ Form::open(array(
        'url'   => 'control',
        'class' => 'col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3',
        //za dodajanje slik uporabnikov
        'files' => true
    )) }}

       <div class="form-group @if($errors->has('oldPassword'))has-error @endif">
            {{ Form::label('oldPassword', 'Geslo (obvezno polje)', array(
                'class' => 'control-label'
            )) }}
            {{ Form::password('oldPassword', array(
                'class'       => 'form-control',
                'placeholder' => 'geslo'
            )) }}
            {{ $up }}
        </div>

        <div class="form-group @if($errors->has('password'))has-error @endif">
            {{ Form::label('password', 'Spremeni geslo', array(
                'class' => 'control-label'
            )) }}
            {{ Form::password('password', array(
                'class'       => 'form-control',
                'placeholder' => 'Novo geslo'
            )) }}
            {{ $errors->first('password', '<p class="help-block">:message</p>') }}
        </div>

        <div class="form-group @if($errors->has('password'))has-error @endif">
            {{ Form::label('password_confirmation', 'Potrdi novo geslo', array(
                'class' => 'control-label'
            )) }}
            {{ Form::password('password_confirmation', array(
                'class'       => 'form-control',
                'placeholder' => 'Novo geslo'
            )) }}
        </div>
        
        <div class="form-group @if($errors->has('slika'))has-error @endif">
            {{ Form::label('slika', 'Spremeni svojo sliko', array(
                'class' => 'control-label'
            )) }}
            {{ Form::file('slika', '', array(
                'class' => 'form-control',
            )) }}
            {{ $errors->first('slika', '<p class="help-block">:message</p>') }}
        </div>
        
       

        {{ Form::button('Spremeni', array(
            'type'  => 'submit',
            'class' => 'btn btn-primary'
        )) }}

        {{ Form::button('Počisti', array(
            'type'  => 'reset',
            'class' => 'btn btn-danger'
        )) }}

    {{ Form::close() }}
   
    
@stop