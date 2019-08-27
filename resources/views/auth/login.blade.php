@extends('layouts.default')
@section('title', 'Iniciar sesión')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <form action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="username" id="username">
                            Username
                            <input type="text" name="username" class="form-control">
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="password" id="password">
                            Contraseñas
                            <input type="password" name="password" class="form-control">
                        </label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Iniciar Sesi&oacute;n</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
