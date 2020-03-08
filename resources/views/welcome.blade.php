@extends('layouts.default')
@section('title', 'Inicio')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <h3 class="font-weight-bold">HillGamers</h3>
            <h5>¡Servidor de Minecraft HillGamers con survival, residencias, <br> parcelas y más!</h5>
            <br>
            <a href="/vip" class="btn btn-primary">Vuelvete VIP</a>
            @guest
            <a href="/login" class="btn btn-primary">¡Empieza ahora!</a>
            @else
            <a href="/profile" class="btn btn-primary">Bienvenido</a>
            @endguest
        </div>
        <div class="col-md-4 mt-5">
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
    <div class="row mb-2">
        <div class="col-md-12 text-center">
            <div class="card card-static-elevation">
                <div class="card-body">
                    <h5>
                        Hay
                        <span class="font-weight-bold" data-playercounter-ip="mc.hillgamers.com">
                            0
                        </span>
                        jugadores en: <br> <span class="text-primary">mc.hillgamers.com</span>
                    </h5>
                    <h6 class="mt-4 text-muted">Versión: 15.1.2</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-12 mb-3">
            <h4 class="font-weight-bold">Algunos mods como</h4>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-primary card-static-elevation">
                <div class="card-body text-center">
                    <h6 class="text-white">Factions</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-primary card-static-elevation">
                <div class="card-body text-center">
                    <h6 class="text-white">Backpacks</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-primary card-static-elevation">
                <div class="card-body text-center">
                    <h6 class="text-white">Transportes</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/main.js" type="text/javascript"></script>
<script src="https://leonardosnt.github.io/mc-player-counter/dist/mc-player-counter.min.js"></script>
@endsection
