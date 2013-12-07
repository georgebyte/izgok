<h1>Registration Form</h1>

{{Form::open(array('url'=>'register', 'name' => 'registration_form'))}}
    {{-- Username field. ------------------------}}
    {{ Form::label('username', 'Username') }}
    {{ Form::text('username') }}
    {{ $errors->first('username', '<span class="error">:message</span>') }}<br>

    {{-- Email address field. -------------------}}
    {{ Form::label('email', 'Email address') }}
    {{ Form::email('email') }}
    {{ $errors->first('email', '<span class="error">:message</span>') }}<br>

    {{-- Password field. ------------------------}}
    {{ Form::label('password', 'Password') }}
    {{ Form::password('password') }}
    {{ $errors->first('password', '<span class="error">:message</span>') }}<br>

    {{-- Password confirmation field. -----------}}
    {{ Form::label('password_confirmation', 'Password confirmation') }}
    {{ Form::password('password_confirmation') }}<br><br>
	
	{{--  testing purpose --}}
	{{ Form::textarea('description', 'Best field ever!', array('cols' => '50', 'rows' => '10')) }}
	{{ Form::image(asset('my/image.gif', 'submit')) }}


    {{-- Form submit button. --------------------}}
    {{ Form::submit('Register') }}
{{Form::close()}}