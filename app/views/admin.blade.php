@extends('layouts.body')

@section('content')
    <h1>Admin Panel</h1>
    <p>
        <ul>
            <li><a href='admin/user'>Urejanje Uporabnika</a></li>
            <li><a href='admin/npc'>Dodajanje NPCjev</a></li>
            <li><a href='admin/question'>Dodajanje Vprasanj</a></li>
        </ul>

        Game Version - v{{Config::get('version.majorVersion');}}.{{Config::get('version.minorVersion');}}
    </p>
@stop