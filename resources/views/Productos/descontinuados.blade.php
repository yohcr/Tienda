@extends('layouts.app')

@section('content')
<div class="container">
  @include('flash-messages')
   <div class="row">
      <div class="col-sm-8">
         <h1>Productos descontinuados</h1>
      </div>
      <!--
      <div class="col-sm">
          <a href="{{ route('nuevoproducto') }}" class="btn btn-success mb-2 btn-block"> <span class="fas fa-plus"></span> Agregar nuevo</a>
      </div>
      -->
      <div class="col-sm">
          <a href="{{ route('productos') }}" class="btn btn-success mb-2 btn-block"><span class="fas fa-check"></span> Habilitados </a>
      </div>
      
   </div>
      <br>

	<form method="POST" action="{{ route('buscarproducto') }}">
    @csrf
    @method('POST')
    <div class="row">
      <div class="col-sm">
         <input type="text" class="form-control mb-2" id="buscarProducto" name="nombre" placeholder="Codigo o nombre">
      </div>
      
      <div class="col-sm">
        <select class="custom-select mb-2 " name="proveedor">
          <option value="-1" selected>Seleccionar proveedor</option>
          @foreach($proveedores as $proveedor)
            <option value="{{$proveedor->id}}">{{$proveedor->empresa}}</option>
          @endforeach
        </select>
      </div>

      <div class="col-sm">
        <button type="submit"  class="btn btn-primary mb-2 btn-block"> <span class="fas fa-search"></span> Buscar</button>
      </div> 
    </div> 
	</form>

	<br>

	<h3>Resultados</h3>
	<table class="table" id="resultados">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Nombre</th>
      <th scope="col">Presentacion</th>
      <th scope="col">Proveedor</th>
      <th scope="col">Precio de Venta</th>
      <th scope="col">Existencias</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  @if($productos==null)
    <tr>
      <td colspan="5" class="text-xs-center" >No se encontraron resultados</td>
    </tr>
    @else
  
      @foreach($productos as $producto )
      <tr>
        <th scope="row">{{$producto->codigo}}</th>
        <td>{{$producto->nombre_producto}}</td>
        <td>{{$producto->presentacion}}, {{$producto->presentacion_2}}</td>
      <!--  $proveedores as $proveedor   $producto->proveedor_id.$proveedor->empresa -->
        <td>{{$producto->empresa}}</td>

        <td>${{$producto->precio}}</td>
        <td>{{$producto->existencias}}</td>
        <td>

        <form  style="display: inline;" action="{{route('habilitarproducto', $producto->id)}}" method="post">
          @csrf
           @method('PUT')
          <button class="btn btn-success btn-sm" onclick="return confirm('¿Seguro de  habilitar nuevamente el producto seleccionado?')"  title="Habilitar"> <i class="fas fa-check-square"></i>
          </button>
        </form>

      </td>
      </tr>
      @endforeach
      @endif
  </tbody>
</table>
</div>
@endsection
