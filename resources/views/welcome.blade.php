@extends('layouts.default')
@section('title', 'Inicio')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <h2 class="font-weight-bold">HillGamers</h2>
            <h4>¡Servidor de Minecraft HillGamers con survival, residencias, <br> parcelas y más!</h4>
            <br>
            <a href="/vip" class="btn btn-primary">Vuelvete VIP</a>
            @guest
            <a href="/login" class="btn btn-primary">¡Empieza ahora!</a>
            @else
            <a href="/profile" class="btn btn-primary">Bienvenido</a>
            @endguest
        </div>
        <div class="col-md-4">
            <div class="cube360">
                <div class="cube">
                    <div class="front-side"><img src="https://i.pinimg.com/originals/27/bb/f7/27bbf79998317ed46ebab78e8d936172.png"></div>
                    <div class="back-side"><img src="https://i.pinimg.com/originals/27/bb/f7/27bbf79998317ed46ebab78e8d936172.png"></div>
                    <div class="left-side"><img src="https://i.pinimg.com/originals/27/bb/f7/27bbf79998317ed46ebab78e8d936172.png"></div>
                    <div class="right-side"><img src="https://i.pinimg.com/originals/27/bb/f7/27bbf79998317ed46ebab78e8d936172.png"></div>
                    <div class="top-side"><img src="https://i.pinimg.com/originals/27/bb/f7/27bbf79998317ed46ebab78e8d936172.png"></div>
                    <div class="bottom-side"><img src="https://i.pinimg.com/originals/27/bb/f7/27bbf79998317ed46ebab78e8d936172.png"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="card card-static-elevation">
                <div class="card-body">
                    <h4>
                        Hay
                        <span class="font-weight-bold" data-playercounter-ip="mc.hillgamers.com">
                            0
                        </span>
                        jugadores en: <br> <span class="text-primary">mc.hillgamers.com</span>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/main.js" type="text/javascript"></script>
<script src="https://leonardosnt.github.io/mc-player-counter/dist/mc-player-counter.min.js"></script>
@endsection
