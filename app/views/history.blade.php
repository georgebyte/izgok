@extends('layouts.body')

@section('content')

    <h1>Zgodovina bitk</h1>
    <br>
    <?php 
    $cnt=0;
    ?>
    <div class="container">
        <a href="/history"> Vsi </a> - 
        <a href="/history/offense"> Napadi </a> - 
        <a href="/history/defense"> Obramba </a> - 
        <a href="/history/unsolved"> Nereseni </a>
        <br><br>
        
            @if(count($attackedTerritoryData) > 0)
                    <?php $attackedTerritoryData = $attackedTerritoryData[0]; ?>
            @endif
            @if(count($attackedTerritoryData) == 0)
                    Zgodovina bitk je prazna.
            @endif
            @foreach($quizIDs as $quizID)
                    <?php 
                    $date=$quizDates[$cnt];
                    $solved = ($solvedQuizes[$cnt]) ? " " : " - še nerešeno";
                    ?>
                     <li> Napad na naselje: 
                             {{ $attackedTerritoryData['name'] }} ({{$attackedTerritoryData['pos_x']}},{{$attackedTerritoryData['pos_y']}})
                             <br>
                             <a href="/quiz/show/{{$quizID}}"> Poročilo bitke - {{ $date}} {{ $solved }}</a></li>
                     <?php $cnt++; ?>
            @endforeach

    </div>
@stop