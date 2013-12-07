@extends('layouts.base')

@section('body')
<div class="container">

    @section('header')
        @include('layouts.header')
    @show
        <div id="main-container">
        <section class="row">
            @section('content_container')
                <section id="main-content" class="col-sm-9">
                    @yield('content')
                </section>
            @show
            @section('sidebar')
                <aside id="sidebar" class="col-sm-3">
                    @include('layouts.sidebar')
                </aside>
            @show
        </section>

        @section('footer')
            @include('layouts.footer')
        @show
    </div>
</div>
@stop