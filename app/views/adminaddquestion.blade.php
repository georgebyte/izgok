@extends('layouts.base')

@section('body')
    <div class="container">

        @section('header')
            @include('layouts.header')
        @show

        <div id="main-container">
            <div class="row">
                <div class="col-sm-6">
                    @if(isset($added))
                        Vprasanje <i>{{ $npcName }}</i> je uspesno dodano.
                    @endif
                    {{ Form::open(array(
                        'url'   => '/admin/question/',
                    )) }}
                        <div class="form-group">
                            {{ Form::label('question', 'Question:') }}&nbsp;
                            {{ Form::text('question', '', array(
                                    'class'       => 'form-control',
                                    'id'          => 'question'
                            )) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('answer1', 'Answer I:') }}
                            {{ Form::text('answer1', '', array(
                                    'class'       => 'form-control',
                                    'id'          => 'answer1'
                            )) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('answer2', 'Answer II:') }}
                            {{ Form::text('answer2', '', array(
                                    'class'       => 'form-control',
                                    'id'          => 'answer2'
                            )) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('answer3', 'Answer III:') }}
                            {{ Form::text('answer3', '', array(
                                    'class'       => 'form-control',
                                    'id'          => 'answer3'
                            )) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('answercorrect', 'Correct Answer:') }}
                            {{ Form::text('answercorrect', '', array(
                                    'class'       => 'form-control',
                                    'id'          => 'answercorrect'
                            )) }}
                        </div>                        
                        {{ Form::button('Add', array(
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


