@extends('layouts.app')

@section('content')
<div class="container">
   @include('flash-messages')

   <div class="row">
      <div class="col-sm">
         <h1>Ventas</h1>
      </div>

      <div class="col-sm">
          <a href="{{ route('nuevaventa') }}" class="btn btn-success mb-2 btn-lg btn-block "><span class="fas fa-plus"></span> Nueva venta</a>
      </div>
      
   </div>
      <br>

	<form method="POST" action="{{route('consultarfecha')}}">
    @csrf
    @method('POST')
    <div class="row">
      <div class="col-sm">
         <input type="date" class="form-control mb-2" name="fecha" >
      </div>

      <div class="col-sm">
        <button type="submit" class="btn btn-primary mb-2 btn-block"> <span class="fas fa-search"></span> Buscar</button>
      </div>
    </div>
	</form>

	<br>

	<h3>Resultados</h3>
	<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Cliente</th>
      <th scope="col">Total</th>
      <th scope="col">Fecha</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @if($ventas==null)
    <tr>
      <td colspan="5" class="text-xs-center" >No se encontraron resultados</td>
    </tr>
    @else
      @foreach($ventas as $venta)
    <tr>
      <td>{{$venta->id}}</td>
      <td>{{$venta->nombre}}</td>
      <td>${{$venta->total}}</td>
      <td>{{\Carbon\Carbon::parse($venta->created_at)->format('d/m/Y')}}</td>

      <td>

        <a href="{{action('VentaController@show', $venta->id)}}" title="Detalles" class="btn btn-info btn-sm">
          <span class="fas fa-plus"></span>
        </a>

      </td>
    </tr>
      @endforeach
    @endif
  </tbody>
</table>



</div>
@endsection