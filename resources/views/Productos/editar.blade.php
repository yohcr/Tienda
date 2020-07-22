@extends('layouts.app')

@section('content')
<div class="container">
  <br>
  <div class="row">
    <div class="col-sm">
      <h1>Editar producto</h1>
    </div>
  </div>

  <br>
  <br>

  <form>

    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label col-form-label-lg">Codigo</label>
      <div class="col-sm-8">
        <input type="text" name="nombre" class="form-control form-control-lg" autocomplete="off" value="123456789">
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label  class="col-sm-2 col-form-label col-form-label-lg">Nombre</label>
      <div class="col-sm-8">
        <input type="text" name="empresa" class="form-control form-control-lg" placeholder="Ingresa el nombre del producto" autocomplete="off" value="Nombre del producto">
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label col-form-label-lg">Presentación</label>
      <div class="col-sm-4">
        <input type="text" name="telefono" class="form-control form-control-lg" placeholder="Ingresa el tipo de presentación" autocomplete="off" value="Botella">
      </div>
      <div class="col-sm-4">
        <select class="form-control form-control-lg">
          <option selected>Selecciona una medida de peso</option>
          <option value="1">Gramo (gr.)</option>
          <option value="2">Kilo-gramo (Kg.)</option>
          <option value="3">Mili-litro (ml.)</option>
          <option value="4" selected>Litro (L.)</option>
        </select>
      </div>
    </div>

    <br>

    <div class="row">
      <div class="col-sm-2"></div>

      <div class="col-sm-4">
        <button type="submit" class="btn btn-danger btn-block mb-2 btn-lg">Cancelar</button>
      </div>

      <div class="col-sm-4">
        <button type="submit" class="btn btn-success btn-block mb-2 btn-lg" >Editar</button>
      </div>

    </div>

  </form>

      


</div>
@endsection