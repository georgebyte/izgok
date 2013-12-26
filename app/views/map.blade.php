@extends('layouts.base')

@section('body')
<div class="container">

    @section('header')
        @include('layouts.header')
    @show
    <div id="main-container">
        <div class='up-arrow'>

        </div>
        <div class='left-arrow'>

        </div>
        <div class='map'>
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
                                <a href='/territory/{{ $currentTerritory['id'] }}/'><img src='/img/village.png'></a>
                            </div>
                        @else
                            <div class='empty_territory'>
                                <img src='/img/empty_territory.png'>
                            </div>
                        @endif
                    @endfor
                </div>
            @endfor
        </div>
        <div class='right-arrow'>

        </div>
        <div class='down-arrow'>

        </div>
        @section('footer')
            @include('layouts.footer')
        @show
    </div>
</div>
@stop