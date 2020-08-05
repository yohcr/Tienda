@extends('layouts.app')

@section('content')
<div class="container">
  <br>
  <h1>Nueva venta</h1>

  <div class="row">
 
  <br>
  <br>

  <div class="col-sm-4">


    <form method="POST" action="{{ route('guardarproveedor') }}">
      @csrf

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 col-form-label col-form-label-lg">Cliente:</label>
        <div class="col">
          <select class="form-control{{ $errors->has('cliente') ? ' is-invalid' : '' }}" name="producto">

            <option  value="0" selected>Selecciona un cliente</option>
            @foreach($clientes as $cliente)
            <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
            @endforeach
            
          </select>

        </div>
      </div>

      <div class="form-group">
        <label  class="col-sm-2 col-form-label col-form-label-lg">Productos:</label>
        <div class="col">
          <select class="form-control{{ $errors->has('producto') ? ' is-invalid' : '' }}" name="producto">

            <option  value="0" selected>Selecciona un producto</option>
            @foreach($productos as $producto)
            <option value="{{$producto->id}}">{{$producto->nombre_producto.' '.$producto->presentacion.' '.$producto->presentacion_2}}</option>
            @endforeach

          </select>

          @if($errors->has('producto'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('producto') }}</strong>
          </span>
          @endif
        </div>
      </div>

      <div class="form-group">
        <label  class="col-sm-2 col-form-label col-form-label-lg">Cantidad:</label>
        <div class="col">
          <input type="number" name="cantidad" class="form-control" min="1">
        </div>
      </div>
      
      <br>

      <div class="form-group">
        <div class="col">
          <button class="form-control btn btn-info btn-block mb-2 ">Agregar </button>
        </div>
      </div>
      <div class="form-group">
        <div class="col">
          <a href="{{route('ventas')}}" class="form-control btn btn-danger btn-block mb-2 "> Cancelar</a>
        </div>
      </div>

    </form>
  </div>

  <div class="col-sm-8">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Producto</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Subtotal</th>
          <th scope="col">Acciones</th>
      </tr>
      </thead>
    </table>
  </div>

</div>


      
</div>
@endsection
