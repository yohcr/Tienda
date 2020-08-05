@extends('layouts.app')

@section('content')
<div class="container">
  <br>
  <div class="row">
    <div class="col-sm">
      <h1>Editar Producto</h1>
    </div>
  </div> <br><br>

  <form method="POST"  action="{{ route('actualizarproducto', $producto->id) }}">
   
    @csrf
    <div class="form-group row">
      <label class="col-sm-2 col-form-label col-form-label-lg">Codigo</label>
      <div class="col-sm-8">
        <input type="text" name="codigo" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }} form-control-lg"  placeholder="Ingresa el codigo" autocomplete="off" value="{{$producto->codigo}}">

        @if ($errors->has('codigo'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('codigo') }}</strong>
          </span>
        @endif
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label  class="col-sm-2 col-form-label col-form-label-lg">Nombre del Producto</label>
      <div class="col-sm-8">
        <input type="text" name="nombre_producto" class="form-control{{ $errors->has('nombre_producto') ? ' is-invalid' : '' }} form-control-lg" placeholder="Ingresa el nombre del producto" autocomplete="off" value="{{$producto->nombre_producto}}">

        @if ($errors->has('nombre_producto'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('nombre_producto') }}</strong>
          </span>
        @endif
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label col-form-label-lg">Presentación</label>
      <div class="col-sm-8">
        <input type="text" name="presentacion" class="form-control{{ $errors->has('presentacion') ? ' is-invalid' : '' }} form-control-lg" placeholder="Presentacion" autocomplete="off" value="{{$producto->presentacion}}">

        @if ($errors->has('presentacion'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('presentacion') }}</strong>
          </span>
        @endif
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label col-form-label-lg">Tipo</label>
      <div class="col-sm-8">
        <input type="text" name="presentacion_2" class="form-control{{ $errors->has('presentacion_2') ? ' is-invalid' : '' }} form-control-lg" placeholder="tipo" autocomplete="off" value="{{$producto->presentacion_2}}">

        @if ($errors->has('presentacion_2'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('presentacion_2') }}</strong>
          </span>
        @endif
      </div>
      <span style="color:red">*</span>
    </div> 
    
    <!---Prueba de extraer proveedor --- Este No se Toca!! -->

  
      <div class="form-group row">
      <label  class="col-sm-2 col-form-label col-form-label-lg">Proveedor</label>
      <div class="col-sm-8">
        <input type="text" name="proveedor_id" class="form-control{{ $errors->has('proveedor_id') ? ' is-invalid' : '' }} form-control-lg" placeholder="Ejemplo S.A." autocomplete="off" value="{{$producto->proveedor_id}}">

        @if ($errors->has('proveedor_id'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('proveedor_id') }}</strong>
            <option  value="{{$producto->proveedor_id}}" ></option>
          </span>
        @endif
      </div>
     <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label col-form-label-lg">Categoria</label>
      <div class="col-sm-8">
        <input type="text" name="categoria" class="form-control{{ $errors->has('categoria') ? ' is-invalid' : '' }} form-control-lg" placeholder="categoria" autocomplete="off" value="{{$producto->categoria}}">

        @if ($errors->has('categoria'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('categoria') }}</strong>
          </span>
        @endif
      </div>
      <span style="color:red">*</span>
    </div>
    
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label col-form-label-lg">Precio</label>
      <div class="col-sm-8">
        <input type="text" name="precio_venta" class="form-control{{ $errors->has('precio_venta') ? ' is-invalid' : '' }} form-control-lg" placeholder="precio" autocomplete="off" value="{{$producto->precio}}">

        @if ($errors->has('precio'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('precio') }}</strong>
          </span>
        @endif
      </div>
      <span style="color:red">*</span>
    </div>
    
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label col-form-label-lg">Existencias</label>
      <div class="col-sm-8">
        <input type="number" min="0" name="existencias" class="form-control{{ $errors->has('existencias') ? ' is-invalid' : '' }} form-control-lg" placeholder="Existencias" autocomplete="off" value="{{$producto->existencias}}">

        @if ($errors->has('existencias'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('existencias') }}</strong>
          </span>
        @endif
      </div>
    </div>
    @method('PUT')
    <br>

    <div class="row">
      <div class="col-sm-2"></div>

      <div class="col-sm-4">
        <button type="submit" class="btn btn-danger btn-block mb-2 btn-lg">Cancelar</button>
      </div>

      <div class="col-sm-4">
        <button type="submit" class="btn btn-success btn-block mb-2 btn-lg">Actualizar</button>
      </div>

    </div>

  </form>

    
</div>
@endsection