@extends('layouts.body')

@section('content')
<?php 
/*
spremenljivke:
$error :: sporocilo napake
$code  :: koda napake
$uri   :: izpis pot (npr: attacK/user/16/16)
*/
?>
    <p>
        Uh nerodno - prišlo je do napake: <br />
        {{ $error }} code: {{ $code }} uri: {{ $uri }}
    </p>
@stop