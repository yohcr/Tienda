@extends('layouts.app')

@section('content')
<div class="container">
   @include('flash-messages')

   <div class="row">
      <div class="col-sm">
         <h1>Compras</h1>
      </div>

      <div class="col-sm">
          <a href="{{ route('nuevacompra') }}" class="btn btn-success mb-2 btn-lg btn-block "><span class="fas fa-plus"></span> Agregar nueva</a>
      </div>
      
   </div>
      <br>

	<form>
    <div class="row">
      <div class="col-sm">
         <input type="date" class="form-control mb-2" id="staticEmail2">
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
      <th scope="col">Proveedor</th>
      <th scope="col">Total</th>
      <th scope="col">Fecha</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @if($compras==null)
    <tr>
      <td colspan="5" class="text-xs-center" >No se encontraron resultados</td>
    </tr>
    @else
      @foreach($compras as $compra)
    <tr>
      <td>{{$compra->id}}</td>
      <td>{{$compra->empresa}}</td>
      <td>{{$compra->total}}</td>
      <td>{{$compra->created_at}}</td>
      <td>

        <a href="{{action('CompraController@show', $compra->id)}}" class="btn btn-primary btn-sm">
          <span class="fas fa-edit"></span>
        </a>

      </td>
    </tr>
      @endforeach
    @endif
  </tbody>
</table>



</div>
@endsection