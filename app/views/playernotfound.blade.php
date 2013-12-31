@extends('layouts.body')

@section('content')

	
	{{ Form::open(array(
        'url'   => 'profile',
        'class' => 'search-form'
    )) }}

        <div class="form-components">
        {{ Form::text('find', '', array(
                'class'       => 'form-control',
                'placeholder' => 'Poišči igralca'
        )) }}
 		</div>
            
        <div class="form-components">
        {{ Form::button('Poišči', array(
            'type'  => 'submit',
            'class' => 'btn btn-primary'
        )) }}
        </div>

    {{ Form::close() }}

	<div class="profile">
		<h3>Ta igralec ne obstaja!</h3>
		
	</div>




@stop