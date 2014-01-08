@extends('layouts.body')

@section('content_container')
    <section id="main-content" class="col-sm-12">
        {{ Form::open(array(
            'url'   => 'auth/login',
            'class' => 'col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3'
        )) }}

            <div class="form-group">
                {{ Form::label('username', 'Uporabniško ime') }}
                {{ Form::text('username', '', array(
                    'class'       => 'form-control',
                    'placeholder' => 'Uporabniško ime'
                )) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Geslo') }}
                {{ Form::password('password', array(
                    'class'       => 'form-control',
                    'placeholder' => 'Geslo'
                )) }}
            </div>

            <div class="checkbox">
                {{ Form::label('remember_me', 'Zapomni si me') }}
                {{ Form::checkbox('remember_me', 'on', true) }}
            </div>
            



            <div class="form-group @if(Session::has('error'))has-error @endif">
                {{ Form::button('Prijava', array(
                    'type'  => 'submit',
                    'class' => 'btn btn-primary'
                )) }}
                @if(Session::has('error'))
                    <p class="help-block">{{ Session::get('error') }}</p>
                @endif
            </div>

        {{ Form::close() }}
    </section>
@stop