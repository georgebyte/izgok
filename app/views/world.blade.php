@extends('layouts.base')

@section('body')
<div class="container">

    @section('header')
        @include('layouts.header')
    @show

    <div id="main-container">
        <?php
        $im = "/map/drawworld";
        ?>
        <div id="world" class="world"><img id="world-map" src="{{asset($im)}}"></div>
    </div>

    @section('footer')
        @include('layouts.footer')
    @show
</div>
<script>
    $(document).ready(function() {
        var img = document.getElementById('world'); 
        var divWidth = img.clientWidth;
        var divHeight = img.clientHeight;
        var imageWidth = {{ $xCenter*2 }};
        var imageHeight = {{ $yCenter*2 }};
        var scrollTop = Math.floor((imageHeight - divHeight)/2);
        var scrollLeft = Math.floor((imageWidth - divWidth)/2);
        $('#world').animate({ scrollTop: scrollTop}, 500);
        $('#world').animate({ scrollLeft: scrollLeft}, 500);
    });
</script>
@stop