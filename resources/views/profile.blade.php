@extends('layouts.default')
@section('title', 'Perfil')
@section('content')
<section class="section-profile-background">
    <div class="container mt-3">
        <div class="row">
            <div class="col text-center">
                <h3 class="font-weight-bold">¡Hola, {{ $user->realname }}!</h3>
            </div>
        </div>
    </div>
</section><br>
<div class="container">
    <div class="row">
        <div class="col-12 text-center mb-2">
            <img src="https://minotar.net/armor/bust/{{ $user->username }}" alt="{{ $user->realname }}">
        </div>
        <div class="col-12 mb-2">
            <div class="card card-static-elevation text-center">
                <div class="card-body">
                    <h4 class="font-weight-bold">¡Comienza a jugar ahora!</h4>
                    <h4>IP: <span class="text-primary">mc.hillgamers.com</span></h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
