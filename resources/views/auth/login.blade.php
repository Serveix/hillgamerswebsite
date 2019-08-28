@extends('layouts.default')
@section('title', 'Iniciar sesión')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('login') }}" method="POST" class="form-row">
                        @csrf
                        <div class="form-group col-8">
                            <label for="username" id="username">
                                Username
                            </label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group col-8">
                            <label for="password" id="password">
                                Contraseñas
                            </label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group col-8">
                            <button class="btn btn-primary" type="submit">Iniciar Sesi&oacute;n</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
