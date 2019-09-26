@extends('layouts.default')
@section('title', 'Perfil')
@section('content')
<section class="section-profile-background">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h1 class="text-poppins  font-weight-bold">¡Hola, {{ $user->realname }}!</h1>
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
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="font-weight-bold">¡Comienza a jugar ahora!</h2>
                    <h2>IP: mc.hillgamers.com</h2>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
