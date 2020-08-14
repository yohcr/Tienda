@extends('layouts.app')

@section('content')
<div class="container">
  <br>
  <div class="row">
    <div class="col-sm">
      <h1>Nuevo producto</h1>
    </div>
  </div>

  <br>
  <br>

  <form method="POST" action="{{ route('guardarproducto') }}">
    @csrf

    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label col-form-label-lg">Código</label>
      <div class="col-sm-8">
        <input type="text" name="codigo" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }} form-control-lg" autocomplete="off" placeholder="000000">

        @if ($errors->has('codigo'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('codigo') }}</strong>
          </span>
        @endif
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label  class="col-sm-2 col-form-label col-form-label-lg">Nombre</label>
      <div class="col-sm-8">
        <input type="text" name="nombre_producto" class="form-control{{ $errors->has('nombre_producto') ? ' is-invalid' : '' }} form-control-lg" placeholder="Ingresa el nombre del producto" autocomplete="off">
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
      <div class="col-sm-4">
        <input type="text" name="presentacion" class="form-control{{ $errors->has('presentacion') ? ' is-invalid' : '' }} form-control-lg" placeholder="000" autocomplete="off">
        @if ($errors->has('presentacion'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('presentacion') }}</strong>
          </span>
        @endif
      </div>
      <span style="color:red">*</span>
      <div class="col-sm-4">
        <select class="form-control{{ $errors->has('presentacion_2') ? ' is-invalid' : '' }} form-control-lg" name="presentacion_2">
          <option value="0" selected>Selecciona una medida de peso</option>
          <option value="gr">Gramo (gr.)</option>
          <option value="Kg">Kilogramo (Kg.)</option>
          <option value="ml">Mililitro (ml.)</option>
          <option value="Lto">Litro (L.)</option>
          <option value="pzas">Piezas (pzas)</option>
        </select>
        @if ($errors->has('presentacion_2'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('presentacion_2') }}</strong>
          </span>
        @endif
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label  class="col-sm-2 col-form-label col-form-label-lg">Proveedor</label>
      <div class="col-sm-8">
       <select class="form-control{{ $errors->has('proveedor') ? ' is-invalid' : '' }} form-control-lg" name="proveedor">
       
          <option  value="0" selected>Selecciona un proveedor</option>
           @foreach($proveedores as $proveedor)
          <option value="{{$proveedor->id}}">{{$proveedor->empresa}}</option>
          @endforeach
        </select>
        @if ($errors->has('proveedor'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('proveedor') }}</strong>
          </span>
        @endif
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label  class="col-sm-2 col-form-label col-form-label-lg">Categoría</label>
      <div class="col-sm-8">
        <select name="categoria" class="form-control{{ $errors->has('categoria') ? ' is-invalid' : '' }} form-control-lg">
          <option value="0" selected>Selecciona una categoría</option>
          <option value="Lácteos">Lácteos</option>
          <option value="Jugos">Jugos</option>
          <option value="Refrescos">Refrescos</option>
          <option value="Embutidos">Embutidos</option>
          <option value="Botanas">Botanas</option>
          <option value="Galletas">Galletas</option>
          <option value="Dulces">Dulces</option>
          <option value="Abarrote">Abarrote</option>
          <option value="Limpieza">Limpieza</option>
          <option value="Higiene personal">Higiene Personal</option>
          <option value="Otros">Otros</option>
        </select>
        @if ($errors->has('categoria'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('categoria') }}</strong>
          </span>
        @endif
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label  class="col-sm-2 col-form-label col-form-label-lg">Precio de venta</label>
      <div class="col-sm-8">

        <input type="number" name="precio_venta" class="form-control{{ $errors->has('precio_venta') ? ' is-invalid' : '' }} form-control-lg" placeholder="00.00" autocomplete="off" step="any" min="0">

        @if ($errors->has('precio_venta'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('precio_venta') }}</strong>
          </span>
        @endif
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label  class="col-sm-2 col-form-label col-form-label-lg">Existencias</label>
      <div class="col-sm-8">
        <input type="number" name="existencias" class="form-control{{ $errors->has('existencias') ? ' is-invalid' : '' }} form-control-lg" min="0" placeholder="0" autocomplete="off" >
      </div>
    </div>

    <br>

    <div class="row">
      <div class="col-sm-2"></div>

      <div class="col-sm-4">
          <a href="{{ route('productos') }}" onclick="return confirm('¿Seguro que desea salir?')" class="btn btn-danger mb-2 btn-lg btn-block "> Cancelar</a>
      </div>

      <div class="col-sm-4">
        <button type="submit" class="btn btn-success btn-block mb-2 btn-lg" >Registrar</button>
      </div>

    </div>

  </form>

      


</div>
@endsection