<header class="row">
    <div class="logo col-lg-3">
        <a href="{{ URL::to('/') }}"><img src='/img/iZGOK_logo.png'></a>
    </div>
    <div class="navigation-container col-lg-9">
        @section('navigation')
            @include('layouts.navigation')
        @show
    </div>
</header>