@extends('layouts.app')

@section('content')
@php
	use App\Venta;
	use Carbon\Carbon;
  	use App\Proveedor;
  	$dia = Carbon::now();
    $day = Carbon::parse($dia)->format('l');
    switch ($day) {
        case 'Monday':
            $day = 'Lunes';
            break;
        case 'Tuesday':
            $day = 'Martes';
            break;
        case 'Wednesday':
            $day = 'Miercoles';
            break;
        case 'Thursday':
            $day = 'Jueves';
            break;
        case 'Friday':
            $day = 'Viernes';
            break;
        case 'Saturday':
            $day = 'Sabado';
            break;
        case 'Sunday':
            $day = 'Domingo';
            break;
        default:
            $day = 'None';
            break;
    }
    $proveedores = Proveedor::where('dia_visita','=',$day)->get();
  	$fecha = Carbon::now();
    $ventas = Venta::where('created_at','=',$fecha)->get();

    $ventas = DB::table('ventas')->get();
    $totalventas = 0;
    foreach ($ventas as $venta) {
    	$totalventas += $venta->total;
    }

    $ventas = DB::table('compras')->get();
    $totalcompras = 0;
    foreach ($ventas as $venta) {
    	$totalcompras += $venta->total;
    }

@endphp
<div class="container">

	<div class="row">

		<div class="col-sm-6">
			<div class="card text-center">
				<div class="card-body">
					<h1>Total de ventas</h1>
					<h2 class="card-title">${{$totalventas}}

					</h2>
					<!--<a href="#" class="btn btn-primary">Consultar ventas del día</a>-->
				</div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="card text-center">
				<div class="card-body">
					<h1>Total de Compras</h1>
					<h2 class="card-title">${{$totalcompras}}</h2>
					<!--<a href="#" class="btn btn-primary">Consultar compras del día</a>-->
				</div>
			</div>
		</div>

	</div>
	<br>

	<div class="card">
		<div class="card-header">
			Visitas de Proveedores del día {{$day}}
		</div>
		@foreach($proveedores as $proveedor)
		<div class="card-body">
			<div class="card">
			  <div class="card-body">
			    <h5 class="card-title">{{$proveedor->empresa}}</h5>
			    <h6 class="card-subtitle mb-2 text-muted">{{$proveedor->nombre_proveedor}}</h6>
			    <p class="card-text">{{$proveedor->telefono}}</p>
			  </div>
			</div>
		</div>
		@endforeach
	</div>

</div>
@endsection