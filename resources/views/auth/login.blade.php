@extends('layouts.default')
@section('title', 'Iniciar sesión')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 text-center mb-5">
                        <h4 class="font-weight-bold text-poppins">Iniciar sesión</h4>
                        <h6 class="text-muted">Ingresa con tu cuenta del servidor del juego</h6>
                    </div>
                    <form action="{{ route('login') }}" method="POST" class="form-row">
                        @csrf
                        <div class="form-group col-12">
                            <label for="username" id="username" class="font-weight-bold">
                                Nombre de usuario
                            </label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <label for="password" id="password" class="font-weight-bold">
                                Contraseña
                            </label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group col-12 text-right">
                            <button class="btn btn-primary" type="submit">Iniciar Sesi&oacute;n</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
