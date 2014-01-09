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
        <div id="world"><img src="{{asset($im)}}"></div>

    </div>    
    @section('footer')
        @include('layouts.footer')
    @show
</div>
<script src="/js/overscroll.js"></script>
<script>
$(document).ready(function(){
    $("#world").overscroll();
});
</script>
@stop