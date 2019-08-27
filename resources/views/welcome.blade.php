@extends('layouts.default')
@section('title', 'Inicio')
@section('styles')
<link rel="stylesheet" href="css/home.css">
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col text-center">
			Hay
			<span data-playercounter-ip="mc.hillgamers.com:39535">
				0
			</span>
			jugadores en <span>mc.hillgamers.com:39535</span>
		</div>
	</div>
</div>
	<script src="js/main.js" type="text/javascript"></script>
	<script src="https://leonardosnt.github.io/mc-player-counter/dist/mc-player-counter.min.js"></script>
@endsection