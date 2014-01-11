@extends('layouts.base')

@section('body')
    <div class="container">

        @section('header')
            @include('layouts.header')
        @show

        <div id="main-container">
            {{ Form::open(array(
                'url'   => 'profile',
                'class' => 'form-inline'
            )) }}
                <div class="form-group">
                    {{ Form::text('find', '', array(
                            'class'       => 'form-control',
                            'placeholder' => 'Poišči igralca',
                            'id'          => 'username'
                    )) }}
                </div>
                {{ Form::button('<span class="glyphicon glyphicon-search"></span>', array(
                    'type'  => 'submit',
                    'class' => 'btn btn-primary scorebord-players-search'
                )) }}
            {{ Form::close() }}
            <div class="scorebord clearfix">
                <h1>Lestvica igralcev</h1>
                <div class="scorebord-players-list">
                    @foreach($scores as $nameAndImage => $score)
                        <?php 
                        $array=explode(" ", $nameAndImage);
                        ?>
                        <div class="scorebord-players-list-item">
                            <div class="pic-name">
                                <img src='{{asset($array[1])}}' alt='{{ $array[0] }}' class="img-thumbnail">
                                <a href='/profile/show/{{ $array[0] }}'>{{$array[0]}}</a>
                            </div>
                            <div class="score">
                                {{$score}} točk
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="scorebord-pagination">
                    @if($start && $end)
                        <a class="btn btn-primary" href='/scoreboard/show/{{ $page-$pageLength }}'><span class="glyphicon glyphicon-chevron-left"></span></a>
                        <a class="btn btn-primary" href='/scoreboard/show/{{ $page+$pageLength }}'><span class="glyphicon glyphicon-chevron-right"></span></a>
                    @elseif($start)
                        <a class="btn btn-primary" href='/scoreboard/show/{{ $page-10 }}'><span class="glyphicon glyphicon-chevron-left"></span></a>
                        <a class="btn btn-primary disabled" href=''><span class="glyphicon glyphicon-chevron-right"></span></a>
                    @elseif($end)
                        <a class="btn btn-primary disabled" href=''><span class="glyphicon glyphicon-chevron-left"></span></a>
                        <a class="btn btn-primary" href='/scoreboard/show/{{ $page+$pageLength }}'><span class="glyphicon glyphicon-chevron-right"></span></a>
                    @endif
                </div>
            </div>
        </div>

        @section('footer')
            @include('layouts.footer')
        @show
    </div>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="/js/UserAutoComplete.js"></script>
@stop