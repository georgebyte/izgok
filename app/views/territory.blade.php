@extends('layouts.body')

@section('content')

<div class="territory-profile">
    <div class="row">
        <div class="territory-image col-sm-4">
            @if ($territoryID)
                <img src='/img/village.png'>
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
                <a href="/quiz/attack/{{ $playerID }}/{{ $territoryID }}" class="btn btn-danger btn-lg"><apan class="glyphicon glyphicon-fire"></span> Napad</a>
                <a href="#" class="btn btn-success btn-lg @if(!$playerID) disabled @endif"><apan class="glyphicon glyphicon-comment"></span> Klepet</a>
            </div>   
        </div>
    </div>
</div>
@stop