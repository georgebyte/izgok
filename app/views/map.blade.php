@extends('layouts.base')

@section('body')
<div class="container">

    @section('header')
        @include('layouts.header')
    @show
    <div id="main-container">
        <div class='map-info-container row'>
            <div class='map-container col-sm-9'>
                <div class='coordinates'>
                    <h3>({{ $x }}, {{ $y }})</h3>
                </div>
                <div class='map'>
                    <?php $villageIndex = 0; ?>
                    @for ($currentY = $y-$visibleMapSize; $currentY <= $y+$visibleMapSize; $currentY++)
                        <div class='map-row clearfix'>
                            @for ($currentX = $x-$visibleMapSize; $currentX <= $x+$visibleMapSize; $currentX++)
                                <?php
                                $currentTerritory = null;
                                foreach ($visibleTerritories as $territory) {
                                    if ($territory['pos_x'] == $currentX && $territory['pos_y'] == $currentY) {
                                        $currentTerritory = $territory;
                                        break;
                                    }
                                } ?>

                                @if ($currentTerritory)
                                    <div class='village'>
                                        <?php 
                                        $territoryID = $currentTerritory['id'];
                                        ?>
                                        <a href='/map/territory/{{ $territoryID }}/{{ $currentX }}/{{ $currentY }}'>
                                            @if($currentTerritory['is_main_village'] == 1)
                                                <img data-village='{{ $currentTerritory['name'] }}' data-leader='{{ $leaders[$territoryID] }}' src='/img/village.png'>
                                            @endif
                                            @if($currentTerritory['is_main_village'] == 0 && $currentTerritory['is_npc_village'] == 0)
                                                <img data-village='{{ $currentTerritory['name'] }}' data-leader='{{ $leaders[$territoryID] }}' src='/img/smallvillage.png'>
                                            @endif
                                            @if($currentTerritory['is_npc_village'] == 1)
                                                <img data-village='{{ $currentTerritory['name'] }}' data-leader='{{ $leaders[$territoryID] }}' src='/img/npcvillage.png'>
                                            @endif                                                                                      
                                        </a>
                                    </div>
                                    <?php $villageIndex++; ?>
                                @else
                                    <div class='empty_territory'>
                                        <a href='/map/territory/0/{{ $currentX }}/{{ $currentY }}'>
                                            @if ($currentX % 9 == 0 && $currentY % 4 == 0)
                                                <img src='/img/empty_territory_1.png'>
                                            @elseif ($currentX % 4 == 0 && $currentY % 7 == 0)
                                                <img src='/img/empty_territory_2.png'>
                                            @elseif ($currentX % 7 == 0 && $currentY % 5 == 0)
                                                <img src='/img/empty_territory_3.png'>
                                            @elseif ($currentX % 7 == 0 && $currentY % 9 == 0)
                                                <img src='/img/empty_territory_4.png'>
                                            @else
                                                <img src='/img/empty_territory_0.png'>
                                            @endif
                                        </a>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    @endfor
                </div>
            </div>
            <div class='info-container col-sm-3'>
                <div class='map-navigation'>
                    <div class='map-up'>
                        <a href='/map/show/{{ $x }}/{{ $y-1 }}'><img src='/img/map_arrow.png'></a>
                    </div>
                    <div class='map-left'>
                        <a href='/map/show/{{ $x-1 }}/{{ $y }}'><img src='/img/map_arrow.png'></a>
                    </div>
                    <div class='map-right'>
                        <a href='/map/show/{{ $x+1 }}/{{ $y }}'><img src='/img/map_arrow.png'></a>
                    </div>
                    <div class='map-down'>
                        <a href='/map/show/{{ $x }}/{{ $y+1 }}'><img src='/img/map_arrow.png'></a>
                    </div>
                </div>
                <div class='territory-info'>
                    <table class="table">
                        <tr>
                            <td>Ime naselja</td>
                            <td class='village-name'>---</td>
                        </tr>
                        <tr>
                            <td>Vladar</td>
                            <td class='player-name'>---</td>
                        </tr>
                    </table>
                    <br>
                        {{ Form::open(array('name' => 'travel','url' => 'admin/usersubmit')) }}
                   
                        <div class="row">
                            <div class="col-xs-1">
                                {{ Form::label('x', 'X:') }}&nbsp;
                                {{ Form::text('x', '0', array('id' => 'search_x', 'placeholder' => 'x')) }}
                            </div>
                            <div class="col-xs-1">
                                {{ Form::label('y', 'Y:') }}&nbsp;
                                {{ Form::text('y', '0', array('id' => 'search_y', 'placeholder' => 'y')) }}
                            </div>
                        </div>
                        <br>

                   {{ Form::close() }}
                    {{ Form::button('Travel', array('id' => 'search_pos', 'name' => 'travel', 'type' => 'submit', 'class' => 'btn btn-primary')) }}
                </div>
            </div>
        </div>
    </div>
    
    @section('footer')
        @include('layouts.footer')
    @show
</div>
<script src="/js/MapTerritoryInfo.js"></script>
@stop