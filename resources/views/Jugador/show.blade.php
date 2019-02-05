@extends('layouts.layout')
@section('content')
    <style>
        .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 100%;
        }

        .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        .container {
        padding: 2px 16px;
        }
        .container-fluid{
            margin-top: 50px !important;
        }
    </style>

    <div class="row">
        <section class="content">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-6"><h3>Detalles del jugador</h3></div>
                    <div class="col-md-6 text-right"><h3><a href="{{ route('jugador.index') }}" class="btn btn-info " >Atrás</a></h3></div>
                </div>
                <div class="card">
                    @if(($jugador->foto)!="")
                        <img src="{{asset('uploads/'.$jugador->foto)}}" style="width:100%">
                    @endif
                    <div class="container">
                        <h4><b>{{$jugador->nombre}}</b></h4> 
                        <p class="card-text">Clase: {{$jugador->clase}}</p>
                        <p class="card-text">Nivel: {{$jugador->nivel}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </section>
    </div>
@endsection