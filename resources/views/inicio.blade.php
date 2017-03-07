@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @if(Auth::user()->getRol->idRol == 2)
            <admin></admin>
        @elseif(Auth::user()->getRol->idRol == 3)
            <supervisor></supervisor>
        @elseif(Auth::user()->getRol->idRol == 4)
            <revisor></revisor>
        @else
            ERROR :  Sin asignacion de perfil
        @endif


    </div>
@endsection
