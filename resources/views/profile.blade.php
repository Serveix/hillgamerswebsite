@extends('layouts.default')
@section('title', 'Perfil')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            ¡Hola, {{ $user->realname }}!
        </div>

    </div>
</div>
@endsection