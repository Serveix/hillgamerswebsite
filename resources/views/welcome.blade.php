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


	<script src="https://code.jquery.com/jquery-1.11.2.min.js" type="text/javascript"></script>
	<script src="js/main.js" type="text/javascript"></script>
@endsection