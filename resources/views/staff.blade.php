@extends('layouts.default')
@section('title', 'Staff')
@section('content')
<section class="section-staff-background">
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="font-weight-bold">&iexcl;Estamos para ayudarte!</h3>
            </div>
        </div>
    </div>
</section><br>
<div class="container">
    <div class="row">
        @foreach($staff as $user)
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body text-center">
                    <h3 class="font-weight-bold text-poppins mb-3">{{ $user->realname }}</h3>
                    <img src="https://minotar.net/armor/bust/{{ $user->username }}" alt="{{ $user->realname }}">
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
