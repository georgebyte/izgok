@extends('layouts.base')

@section('body')
    <div class="container">

        @section('header')
            @include('layouts.header')
        @show

        <div id="main-container">
            <div class="row">
                <div class="col-sm-6">
                    {{ Form::open(array(
                        'url'   => 'profile/edit/',
                    )) }}
                        <div class="form-group">
                            {{ Form::hidden('id', $territoryInfo['id'])}}
                            {{ Form::label('name', 'Ime naselja:') }}&nbsp;
                            {{ Form::text('name', $territoryInfo['name'], array(
                                    'class'       => 'form-control',
                                    'id'          => 'name'
                            )) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Opis naselja:') }}
                            {{ Form::textarea('description', $territoryInfo['description'],array(
                                    'class'       => 'form-control',
                                    'id'          => 'description'
                            )) }}
                        </div>
                        {{ Form::button('Uredi', array(
                            'type'  => 'submit',
                            'class' => 'btn btn-primary'
                        )) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>

        @section('footer')
            @include('layouts.footer')
        @show
    </div>
@stop


