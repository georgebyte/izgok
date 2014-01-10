@extends('layouts.body')

@section('content')

    

    
        <div id="main-container">
            {{ Form::open(array(
                'url'   => 'profile/edit/',
                'class' => 'form-inline'
            )) }}
                <div class="form-group">
                    {{ Form::hidden('id', $territoryInfo['id'])}}
                    {{ Form::label('name', 'Ime naselja:') }}&nbsp;
                    {{ Form::text('name', $territoryInfo['name'], array(
                            'class'       => 'form-control',
                            'id'          => 'name'
                    )) }}
                    {{ Form::label('description', 'Opis naselja:') }}<br>
                    {{ Form::textarea('description', $territoryInfo['description'],array(
                            'class'       => 'form-control',
                            'id'          => 'description'
                    )) }}<br>
                    {{ Form::button('Uredi', array(
                    'type'  => 'submit',
                    'class' => 'btn btn-primary scorebord-players-search'
                )) }}

                </div>
               
            {{ Form::close() }}
            
        @section('footer')
            @include('layouts.footer')
        @show
    


       
    </div>


@stop


