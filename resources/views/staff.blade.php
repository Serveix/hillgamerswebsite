@extends('layouts.default')
@section('title', 'Staff')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h1>&iexcl;Estamos para ayudarte!</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            @foreach($staff as $user)
            <div class="col-md-4">
                {{ $user->realname }}
                <img src="https://minotar.net/armor/bust/{{ $user->username }}" alt="{{ $user->realname }}">

            </div>
            @endforeach
        </div>
    </div>
@endsection