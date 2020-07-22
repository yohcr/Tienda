@extends('layouts.app')

@section('content')
<div class="container">
  @include('flash-messages')
   <div class="row">
      <div class="col-sm">
         <h1>Productos</h1>
      </div>

      <div class="col-sm">
      </div>

      <div class="col-sm">
          <a href="{{ route('nuevoproducto') }}" class="btn btn-success mb-2 btn-lg btn-block "><span class="fas fa-plus"></span> Agregar nuevo</a>
      </div>
      
   </div>
      <br>

	<form>
    <div class="row">
      <div class="col-sm">
         <input type="text" class="form-control mb-2" id="staticEmail2" placeholder="Codigo o nombre">
      </div>
      
      <div class="col-sm">
        <select class="custom-select mb-2 ">
          <option selected>Seleccionar proveedor</option>
          <option value="1">Bimbo</option>
          <option value="2">Coca-cola</option>
          <option value="3">Gamesa</option>
        </select>
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
      <th scope="col">Codigo</th>
      <th scope="col">Nombre</th>
      <th scope="col">Presentacion</th>
      <th scope="col">Precio de Venta</th>
      <th scope="col">Existencias</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  
      @foreach($productos as $producto)
      <tr>
        <th scope="row">{{$producto->codigo}}</th>
        <td>{{$producto->nombre_producto}}</td>
        <td>{{$producto->presentacion}}</td>
        <td>${{$producto->precio}}</td>
        <td>{{$producto->existencias}}</td>
        <td>

        <a href="{{action('ProductoController@edit', $producto->id)}}" class="btn btn-primary btn-sm">
          <span class="fas fa-edit"></span>
        </a>

        <form class="" action="{{route('eliminarproducto', $producto->id)}}" method="post">
          @csrf
           @method('DELETE')
          <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar el producto seleccionado?')"  title="Eliminar"> <i class="fas fa-trash"></i>
          </button>
        </form>

      </td>
      </tr>
      @endforeach
 
  </tbody>
</table>



</div>
@endsection