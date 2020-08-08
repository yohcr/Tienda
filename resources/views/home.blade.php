@extends('layouts.app')

@section('content')
@php
	use Carbon\Carbon;
  	use App\Venta;
  	$fecha = Carbon::now();
    
    $ventas = Venta::where('created_at','=',$fecha)->get();
@endphp
<div class="container">

	<div class="row">

		<div class="col-sm-6">
			<div class="card text-center">
				<div class="card-body">
					<h1>Total de ventas</h1>
					<h2 class="card-title">$00.00</h2>
					<!--<a href="#" class="btn btn-primary">Consultar ventas del día</a>-->
				</div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="card text-center">
				<div class="card-body">
					<h1>Total de Compras</h1>
					<h2 class="card-title">$00.00</h2>
					<!--<a href="#" class="btn btn-primary">Consultar compras del día</a>-->
				</div>
			</div>
		</div>

	</div>
	<br>

	<div class="card">
		<div class="card-header">
		Visitas de Proveedores del día
		</div>
		
			<div class="card-body"><!--
				<div class="card" style="width: 18rem;">
					<div class="card-body">
					<h5 class="card-title">Card title</h5>
					<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					<a href="#" class="card-link">Card link</a>
					<a href="#" class="card-link">Another link</a>
				</div>
			</div>-->
		</div>
	</div>

</div>
@endsection