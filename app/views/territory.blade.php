@extends('layouts.body')

@section('content')

<div class="territory-profile">
    <div class="row">
        <div class="territory-image col-sm-4">
            <?php 
            //dd($territoryID); 
            ?>
            @if ($territoryID)
                @if($is_main_village == 1)
                <img src='/img/village.png'>
                @endif

                @if($is_main_village == 0 && $is_npc_village == 0)
                <img src='/img/smallvillage.png'>
                @endif

                @if($is_npc_village == 1)
                <img src='/img/npcvillage.png'>
                @endif

            @else
                @if ($x % 9 == 0 && $y % 4 == 0)
                    <img class="empty-territory-image" src='/img/empty_territory_1.png'>
                @elseif ($x % 4 == 0 && $y % 7 == 0)
                    <img class="empty-territory-image" src='/img/empty_territory_2.png'>
                @elseif ($x % 7 == 0 && $y % 5 == 0)
                    <img class="empty-territory-image" src='/img/empty_territory_3.png'>
                @elseif ($x % 7 == 0 && $y % 9 == 0)
                    <img class="empty-territory-image" src='/img/empty_territory_4.png'>
                @else
                    <img class="empty-territory-image" src='/img/empty_territory_0.png'>
                @endif
            @endif
        </div>
        <div class="col-sm-8">
            <p><h2>{{ $name }} <a href="/map/show/{{ $x }}/{{ $y }}">{{ "(" . $x . ", " . $y .")" }}</a></h2></p>
            <p class="territory-profile-description">{{ $description }}</p>
            @if($playerID)
                <p class="territory-profile-player">Vladar: <a href="/profile/show/{{ $player }}"> {{ $player }}</a></p>
            @endif
            <div class="territory-profile-buttons">
                <a href="/quiz/attack/{{ $playerID }}/{{ $territoryID }}/{{ $x }}/{{ $y }}@if($is_main_village == 1 || $player == Auth::user() -> username)#@endif" class="btn btn-danger btn-lg @if($is_main_village == 1 || $player == Auth::user() -> username)disabled@endif">
                    <apan class="glyphicon glyphicon-fire "></span> Napad
                </a>
                <a href="#" class="btn btn-success btn-lg @if(!$playerID || $is_npc_village == 1) disabled @endif">
                    <apan class="glyphicon glyphicon-comment"></span> Klepet
                </a>
            </div>   
        </div>
    </div>
</div>
@stop