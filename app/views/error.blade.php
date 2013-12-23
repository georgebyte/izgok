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
    	<center><br><br>
        <h3>Uhh... nerodno - prišlo je do napake </h3>
        @if(!empty($code))
        <h2>{{ $code }}</h2>
        @endif
        <h3>{{ $error }}</h3>
        @if(!empty($uri))
        <br> Uporabljena pot: {{ $uri }}
        @endif
        <br>
    	</center>
    </p>
@stop