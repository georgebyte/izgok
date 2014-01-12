@extends('layouts.base')

@section('body')
    <div class="container">

        @section('header')
            @include('layouts.header')
        @show

        <div id="main-container">
            <div class="history clearfix">

                <h1>Zgodovina bitk</h1>
                <?php $cnt=0; ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        @if (preg_match('*history/all*', URL::current()))
                            <span class="glyphicon glyphicon-inbox"></span> Vsa poročila 
                        @elseif (preg_match('*/history/offense*', URL::current()))
                            <span class="glyphicon glyphicon-fire"></span> Napad 
                        @elseif (preg_match('*/history/defense*', URL::current()))
                            <span class="glyphicon glyphicon-tower"></span> Obramba 
                        @elseif (preg_match('*/history/unsolved*', URL::current()))
                            <span class="glyphicon glyphicon-exclamation-sign"></span> Nerešeni oz. nepregledani  
                        @endif
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/history/all"><span class="glyphicon glyphicon-inbox"></span> Vsa poročila</a></li>
                        <li><a href="/history/offense"><span class="glyphicon glyphicon-fire"></span> Napad</a></li>
                        <li><a href="/history/defense"><span class="glyphicon glyphicon-tower"></span> Obramba</a></li>
                        <li><a href="/history/unsolved"><span class="glyphicon glyphicon-exclamation-sign"></span> Nerešeni oz. nepregledani</a></li>
                    </ul>
                </div>
                
                <div class="history-reports-list">   
                    @if(count($attackedTerritoryData) == 0)
                        <p class="history-reports-list-counter">Zgodovina bitk je prazna.</p>
                    @endif

                    @if(count($attackedTerritoryData) > 0)
                        <p class="history-reports-list-counter">Prikazanih {{ count($attackedTerritoryData) }} od {{ $all }}</p>
                        <table class="table table-bordered">
                            @foreach($quizIDs as $quizID)
                                @if(isset($insideTimeLimit))
                                    @if($insideTimeLimit[0])
                                    <?php
                                    $solved = ($solvedQuizes[$cnt]) ? " " : " - še nerešeno"; 
                                    ?>
                                    @endif
                                    @if(!$insideTimeLimit[0])
                                    <?php
                                    $solved = ($solvedQuizes[$cnt]) ? " " : " - še nepregledano"; 
                                    ?>
                                    @endif
                                @else
                                    <?php
                                    $solved = ($solvedQuizes[$cnt]) ? " " : " - še nerešeno";
                                    ?>
                                @endif
                                <tr class="history-reports-list-item">
                                    <td>
                                        <a class="btn btn-primary @if($solved == ' ') disabled@endif" href="/quiz/show/{{$quizID}}"><span class="glyphicon glyphicon-file"></span></a>
                                        <a class="report-link" href="/quiz/show/{{$quizID}}" id="{{$cnt}}">Napad na naselje <strong>{{ $territoryName[$cnt] }}</strong> ({{$territoryPosX[$cnt]}},{{$territoryPosY[$cnt]}})</a>
                                        <!-- <a href="/map/territory/{{ $territoryIDs[$cnt] }}/{{ $territoryPosX[$cnt] }}/{{ $territoryPosY[$cnt] }}/"></a>  -->
                                        <!-- <a href="/quiz/show/{{$quizID}}" id="{{$cnt}}"> Poročilo bitke - {{ $quizDates[$cnt]}} {{ $solved }}</a> -->
                                    </td>
                                    <td class='report-date'>
                                        <span class="report-date">{{ $quizDates[$cnt]}}</span>
                                    </td>
                                </tr>
                                <?php $cnt++; ?>
                            @endforeach
                        </table>
                    @endif

                    @if($all > count($attackedTerritoryData))
                        <?php $i = ($all/5)-1 > 0 ? ($all/5)-1 : 1;?>
                        <a class="btn btn-primary" href="{{ $url }}#{{ $cnt }}">Prikaži več</a>
                    @endif
                </div>
            </div>
        </div>

        @section('footer')
            @include('layouts.footer')
        @show
    </div>
@stop