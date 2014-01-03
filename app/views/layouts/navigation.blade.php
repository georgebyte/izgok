<nav id="navigation" class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Prikaži navigacijo</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <p class="navbar-brand visible-xs">Navigacija</p>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        @if (Auth::check())
            <ul class="game-navigation nav navbar-nav">
                <li><a href="{{ URL::to('profile') }}"><span class="glyphicon glyphicon-user"></span> Profil</a></li>
                <li><a href="{{ URL::to('map') }}"><span class="glyphicon glyphicon-globe"></span> Zemljevid</a></li>
                <li><a href="{{ URL::to('scoreboard') }}"><span class="glyphicon glyphicon-stats"></span> Lestvica igralcev</a></li>
                <li><a href="{{ URL::to('history') }}"><span class="glyphicon glyphicon-envelope"></span> Poročila napadov</a></li>
            </ul>
            <ul class="user-navigation nav navbar-nav navbar-right">
                @if (Auth::user()->is_admin)
                    <li><a href="{{ URL::to('admin') }}">Administracija</a></li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Prijavljen si kot {{ Auth::user()->username }}. <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::to('profile') }}">Ogled profila</a></li>
                        <li><a href="{{ URL::to('control') }}">Nastavitve računa</a></li>
                        <li><a href="{{ URL::to('auth/logout') }}">Odjava</a></li>
                    </ul>
                </li>
            </ul>
        @else
            <p class="guest-notice hidden-xs">Pozdravljen gost! <a href="{{ URL::to('auth/login') }}">Prijavi se</a> oz. <a href="{{ URL::to('auth/register') }}">ustvari nov račun</a>.</p>
            <ul class="nav navbar-nav visible-xs">
                <li><a href="{{ URL::to('auth/login') }}">Prijava</a></li>
                <li><a href="{{ URL::to('auth/register') }}">Registracija</a></li>
            </ul>
        @endif
    </div>
</nav>

