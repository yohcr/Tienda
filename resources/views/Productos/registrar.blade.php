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
      <label for="inputEmail3" class="col-sm-2 col-form-label col-form-label-lg">Codigo</label>
      <div class="col-sm-8">
        <input type="text" name="codigo" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }} form-control-lg" autocomplete="off" placeholder="000000">
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label  class="col-sm-2 col-form-label col-form-label-lg">Nombre</label>
      <div class="col-sm-8">
        <input type="text" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }} form-control-lg" placeholder="Ingresa el nombre del producto" autocomplete="off">
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label col-form-label-lg">Presentación</label>
      <div class="col-sm-4">
        <input type="text" name="presentacion" class="form-control{{ $errors->has('presentacion') ? ' is-invalid' : '' }} form-control-lg" placeholder="000" autocomplete="off">
      </div>
      <span style="color:red">*</span>
      <div class="col-sm-4">
        <select class="form-control{{ $errors->has('presentacion_2') ? ' is-invalid' : '' }} form-control-lg" name="presentacion_2">
          <option value="0" selected>Selecciona una medida de peso</option>
          <option value="1">Gramo (gr.)</option>
          <option value="2">Kilo-gramo (Kg.)</option>
          <option value="3">Mili-litro (ml.)</option>
          <option value="4">Litro (L.)</option>
        </select>
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
        </select>
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label  class="col-sm-2 col-form-label col-form-label-lg">Precio de venta</label>
      <div class="col-sm-8">
        <input type="text" name="precio_venta" class="form-control{{ $errors->has('precio_venta') ? ' is-invalid' : '' }} form-control-lg" placeholder="00.00" autocomplete="off">
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label  class="col-sm-2 col-form-label col-form-label-lg">Existencias</label>
      <div class="col-sm-8">
        <input type="number" name="existencias" class="form-control{{ $errors->has('existencias') ? ' is-invalid' : '' }} form-control-lg" placeholder="0" autocomplete="off">
      </div>
    </div>

    <br>

    <div class="row">
      <div class="col-sm-2"></div>

      <div class="col-sm-4">
        <button type="submit" class="btn btn-danger btn-block mb-2 btn-lg">Cancelar</button>
      </div>

      <div class="col-sm-4">
        <button type="submit" class="btn btn-success btn-block mb-2 btn-lg" >Registrar</button>
      </div>

    </div>

  </form>

      


</div>
@endsection