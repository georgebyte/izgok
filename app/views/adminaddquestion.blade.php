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
                        </div>
                        <div class="form-group">
                            {{ Form::label('answer_1', 'Answer I:') }}
                            {{ Form::text('answer_1', '', array(
                                    'class'       => 'form-control',
                                    'id'          => 'answer_1'
                            )) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('answer_2', 'Answer II:') }}
                            {{ Form::text('answer_2', '', array(
                                    'class'       => 'form-control',
                                    'id'          => 'answer_2'
                            )) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('answer_3', 'Answer III:') }}
                            {{ Form::text('answer_3', '', array(
                                    'class'       => 'form-control',
                                    'id'          => 'answer_3'
                            )) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('answer_correct', 'Correct Answer:') }}
                            {{ Form::text('answer_correct', '', array(
                                    'class'       => 'form-control',
                                    'id'          => 'answer_correct'
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


