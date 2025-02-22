@extends('layouts.app')

@section('content')
<div class="container">
  <br>
  <div class="row">
    <div class="col-sm">
        <a href="{{ route('ventas') }}" class="btn btn-info mb-2 "><span class="fas fa-arrow-left"></span> Volver</a>
    </div>
  </div>

  <div class="row">
    <div class="col-sm">
      <h1>Detalle de Venta:</h1>
    </div>
  </div>
  <br>
  @foreach($ventas as $venta)
    <p>Folio: {{$venta->id}}</p>
    <p>Fecha: {{\Carbon\Carbon::parse($venta->created_at)->format('d/m/Y')}}</p>
    <p>Cliente: {{$venta->nombre}}
  @endforeach

  <table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Producto</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Subtotal</th>
    </tr>
  </thead>
  <tbody>
    @if($detalleventa==null)
    <tr>
      <td colspan="5" class="text-xs-center" >No se encontraron resultados</td>
    </tr>
    @else
      @foreach($detalleventa as $detalle)
    <tr>
      <td>{{$detalle->codigo}}</td>
      <td>{{$detalle->nombre_producto}}</td>
      <td>{{$detalle->cantidad}}</td>
      <td>${{$detalle->subtotal}}</td>
    </tr>
      @endforeach
    <tr>
        <td colspan="3" class="text-right">
          <h4>TOTAL</h4>
        </td>
        <td>
          <h4>${{$venta->total}}</h4>
        </td>
    </tr>
    @endif
  </tbody>
</table>
</div>
@endsection