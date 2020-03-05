@extends('layouts.default')
@section('title', 'Perfil')
@section('content')
<section class="section-profile-background">
    <div class="container mt-4">
        <div class="row">
            <div class="col text-center">
                <h3 class="font-weight-bold">¡Hola, {{ $user->realname }}!</h3>
            </div>
        </div>
    </div>
</section><br>
<div class="container">
    <div class="row">
        <div class="col-12 text-center mb-3">
            <img src="https://minotar.net/armor/bust/{{ $user->username }}" alt="{{ $user->realname }}">
        </div>
        <div class="col-12 mb-3"> 
            <div class="card card-static-elevation text-center">
                <div class="card-body">
                    <h4 class="font-weight-bold">¡Comienza a jugar ahora!</h4>
                    <h4>IP: <span class="text-primary">mc.hillgamers.com</span></h4>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3"> 
            <div class="card card-static-elevation">
                <div class="card-body">
                    <h4 class="font-weight-bold">Lista de comandos</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Accion</th>
                                    <th>Comando</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>...</th>
                                    <th>...</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
