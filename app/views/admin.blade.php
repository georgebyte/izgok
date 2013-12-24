@extends('layouts.body')

@section('content')
    <h1>Admin Panel</h1>
    <?php 
    if(!isset($error))
        $error = array();
    else
        echo($error); 
    ?>
    <p>
        <ul>
            <li><a href='form/user'>Urejanje Uporabnika</a></li>
            <li><a href='form/territory'>Urejanje Teritorija</a></li>
        </ul>
    </p>
@stop