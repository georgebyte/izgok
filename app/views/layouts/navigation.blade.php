<nav id="navigation" class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Brand</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Link</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
          <li class="divider"></li>
          <li><a href="#">One more separated link</a></li>
        </ul>
      </li>
    </ul>
    @if (Auth::check())
        <p class="navbar-right">Prijavljen si kot {{ Auth::user()->username }}. <a href="{{ URL::to('auth/logout') }}" >Odjava</a>.</p>
    @else
        {{ Form::open(array(
                'url'   => 'auth/login',
                'class' => 'navbar-form navbar-right',
                'role'  => 'login'
            )) }}

            <div class="form-group">
                {{ Form::text('username', '', array(
                    'class'       => 'form-control input-sm',
                    'placeholder' => 'Username'
                )) }}
            </div>

            <div class="form-group">
                {{ Form::password('password', array(
                    'class'       => 'form-control input-sm',
                    'placeholder' => 'Password'
                )) }}
            </div>

            <div class="checkbox">
                {{ Form::label('remember_me', 'Remember me') }}
                {{ Form::checkbox('remember_me', 'on', true) }}
            </div>

            <div class="form-group">
                {{ Form::button('Login', array(
                    'type'  => 'submit',
                    'class' => 'btn btn-primary btn-xs'
                )) }}
            </div>
        {{ Form::close() }}
    @endif
  </div><!-- /.navbar-collapse -->
</nav>