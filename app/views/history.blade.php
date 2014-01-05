@extends('layouts.body')

@section('content')

    <h1>Zgodovina bitk</h1>
    <br>
    <?php 
    $cnt=0;
    $territoryName = array();
    $territoryPosX = array();
    $territoryPosY = array();
    ?>
    <div class="container">
        <a href="/history"> Vsi </a> - 
        <a href="/history/offense"> Napadi </a> - 
        <a href="/history/defense"> Obramba </a> - 
        <a href="/history/unsolved"> Nereseni </a>
        <br><br>
            
            @if(count($attackedTerritoryData) == 0)
                    Zgodovina bitk je prazna.
            @endif
            @if(count($attackedTerritoryData) > 0)
                @foreach($attackedTerritoryData as $key => $value)
                    <?php 
                    array_push($territoryName, $value['name']); 
                    array_push($territoryPosX, $value['pos_x']);
                    array_push($territoryPosY, $value['pos_y']); 
                    ?>
                @endforeach
                @foreach($quizIDs as $quizID)
                        <?php $solved = ($solvedQuizes[$cnt]) ? " " : " - še nerešeno"; ?>
                         <li> Napad na naselje: 
                                 {{ $territoryName[$cnt] }} ({{$territoryPosX[$cnt]}},{{$territoryPosY[$cnt]}})
                                 <br>
                                 <a href="/quiz/show/{{$quizID}}"> Poročilo bitke - {{ $quizDates[$cnt]}} {{ $solved }}</a></li>
                         <?php $cnt++; ?>
                @endforeach
            @endif

    </div>
@stop