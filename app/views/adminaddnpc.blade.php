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
                        NPC {{ $npcName }} je uspesno dodan
                    @endif
                    {{ Form::open(array(
                        'url'   => '/admin/npc/',
                    )) }}
                        <div class="form-group">
                            {{ Form::label('name', 'NPC name:') }}&nbsp;
                            {{ Form::text('name', '', array(
                                    'class'       => 'form-control',
                                    'id'          => 'name'
                            )) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Territory Description:') }}
                            {{ Form::textarea('description', '', array(
                                    'class'       => 'form-control',
                                    'id'          => 'description'
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


