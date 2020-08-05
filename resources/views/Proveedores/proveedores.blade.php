@extends('layouts.app')

@section('content')
<div class="container">
   @include('flash-messages')

   <div class="row">
      <div class="col-sm">
         <h1>Proveedores</h1>
      </div>

      <div class="col-sm">
          <a href="{{ route('nuevoproveedor') }}" class="btn btn-success mb-2 btn-lg btn-block "><span class="fas fa-plus"></span> Agregar nuevo</a>
      </div>
      
   </div>
      <br>

	<form method="POST" action="{{route('buscarproveedor')}}">
    @csrf
    @method('POST')
    <div class="row">
      <div class="col-sm">
         <input type="text" name="nombre" class="form-control mb-2" id="staticEmail2" placeholder="Nombre del proveedor">
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
      <th scope="col">Nombre</th>
      <th scope="col">Empresa</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @if($proveedores==null)
    <tr>
      <td colspan="5" class="text-xs-center" >No se encontraron resultados</td>
    </tr>
    @else
      @foreach($proveedores as $proveedor)
    <tr>
      <td>{{$proveedor->id}}</td>
      <td>{{$proveedor->nombre_proveedor}}</td>
      <td>{{$proveedor->empresa}}</td>
      <td>{{$proveedor->telefono}}</td>
      <td>

        <a href="{{action('ProveedorController@edit', $proveedor->id)}}" class="btn btn-primary btn-sm">
          <span class="fas fa-edit"></span>
        </a>

        <form style="display: inline;" action="{{route('eliminarproveedor', $proveedor->id)}}" method="post">
          @csrf
           @method('DELETE')
          <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar el proveedor seleccionado?')"  title="Eliminar"> <i class="fas fa-trash"></i>
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