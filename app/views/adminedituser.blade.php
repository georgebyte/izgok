@extends('layouts.body')

@section('content')
    <h1>Admin Panel - User Form</h1>
            <?php
                if(isset($userData))
                {
            		$uId = $userData['id'];
            		$uName = $userData['username'];
                    $uEmail = $userData['email'];
                } 

                if(isset($userTerritories))
                {
                    $territoriesArray = array();
                    foreach($userTerritories as $val){
                        $territoryId = $val['id'];
                        $territoryName = $val['name'];
                        $territoriesArray[$territoryId]=$territoryName;
                    }
                }
            ?>
            @if(isset($userData))
                <div class="form-group">
                    <br>
                    {{ Form::open(array('name' => 'userEdit','url' => 'admin/usersubmit')) }}
                        {{ Form::hidden('userid', $uId) }}
                        {{ Form::label('username', 'Username:') }}&nbsp;
                        {{ Form::text('username', $uName) }}
                        <br>
                        {{ Form::label('email', 'Email:') }}&nbsp;
                        {{ Form::text('email', $uEmail) }}
                        <br>
                        {{ Form::button('Edit', array('name' => 'edit', 'type' => 'submit', 'class' => 'btn btn-primary')) }}
                   {{ Form::close() }}
                </div>
                
                <div class="form-group">
                    <h4>{{$uName}}'s territories</h4>
                    {{ Form::open(array('name' => 'territoryEdit','url' => 'admin/deleteterritory/')) }}
                    {{ Form::select('territoryid[]', $territoriesArray, array("M" => "Medium"), array('multiple'))}}<br>
                    {{ Form::button('Delete territory(ies)', array('name' => 'edit', 'type' => 'submit', 'class' => 'btn btn-primary')) }}
                    {{ Form::close() }}
                </div>
            @elseif(isset($deletedTerritories))
                <h4>Territories are deleted.</h4>
                <a href={{ URL::previous() }}>Go back</a>
            @else
                <h4>User is edited.</h4>
                <a href={{ URL::previous() }}>Go back</a>
            @endif
@stop
