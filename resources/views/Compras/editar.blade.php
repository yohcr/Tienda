@extends('layouts.app')

@section('content')
<div class="container">
  <br>
  <div class="row">
    <div class="col-sm">
        <a href="{{ route('compras') }}" class="btn btn-info mb-2 "><span class="fas fa-arrow-left"></span> Volver</a>
    </div>
  </div>

  <div class="row">
    <div class="col-sm">
      <h1>Detalle de Compra:</h1>
    </div>
  </div>
  <br>
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Fecha</th>
        <th scope="col">Proveedor</th>
        <th scope="col">Total</th>
        <th scope="col">Ticket</th>
      </tr>
    </thead>
    <tbody>
        @foreach($compras as $compra)
        <tr>
          <td>{{$compra->id}}</td>
          <td>{{$compra->created_at}}</td>
          <td>{{$compra->empresa}}</td>
          <td>${{$compra->total}}</td>
          <td><a target="_blank" href="{{ asset('images/'.$compra->archivo.'')}}"><img src="{{ asset('images/'.$compra->archivo.'')}}" style="height: 300px;"></a></td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>
@endsection