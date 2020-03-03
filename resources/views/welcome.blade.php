@extends('layouts.default')
@section('title', 'Inicio')
@section('styles')
<link rel="stylesheet" href="css/home.css">
@endsection
@section('content')
<section class="section-welcome-background">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-poppins font-weight-bold">Hillgamers</h1>
            </div>
            <div class="col-12">
                <h2>¡Servidor de Minecraft HillGamers con survival, residencias, <br> parcelas y más!</h2>
                <br>
                <a href="/vip" class="btn btn-secondary-light">Vuelvete VIP</a>
                @guest
                <a href="/login" class="btn">¡Empieza ahora!</a>
                @else 
                <a href="/profile" class="btn">Bienvenido</a>
                @endguest
            </div>
        </div>
    </div>
</section><br>
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <div class="card">
                <div class="card-body">
                    <h2 >
                        Hay
                        <span class="font-weight-bold" data-playercounter-ip="mc.hillgamers.com">
                            0
                        </span>
                        jugadores en: <br> <span class="text-poppins">mc.hillgamers.com</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/main.js" type="text/javascript"></script>
<script src="https://leonardosnt.github.io/mc-player-counter/dist/mc-player-counter.min.js"></script>
@endsection
