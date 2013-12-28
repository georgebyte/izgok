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
                                        <a href='/territory/{{ $currentTerritory['id'] }}/'><img data-ref='{{ $currentTerritory['name'] }}' src='/img/village.png'></a>
                                    </div>
                                    <?php $villageIndex++; ?>
                                @else
                                    <div class='empty_territory'>
                                        @if ($currentX % 9 == 0 && $currentY % 4 == 0)
                                            <img src='/img/empty_territory_1.png'>
                                        @elseif ($currentX % 4 == 0 && $currentY % 7 == 0)
                                            <img src='/img/empty_territory_2.png'>
                                        @elseif ($currentX % 7 == 0 && $currentY % 5 == 0)
                                            <img src='/img/empty_territory_3.png'>
                                        @elseif (abs($currentX - $currentY) == $currentX % 3 && $currentY != 0)
                                            <img src='/img/empty_territory_2.png'>
                                        @else
                                            <img src='/img/empty_territory_0.png'>
                                        @endif
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
                </div>
            </div>
        </div>
        @section('footer')
            @include('layouts.footer')
        @show
    </div>
</div>
<script>
$(document).ready(function() {
    $('.village img').mouseover(function(){
        $('.village-name').html($(this).data('ref'));
    });
    $('.village img').mouseout(function(){
        $('.village-name').html('---');
    });
});
</script>
@stop