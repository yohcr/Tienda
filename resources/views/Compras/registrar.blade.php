@extends('layouts.app')

@section('content')
<div class="container">
  <br>
  <div class="row">
    <div class="col-sm">
      <h1>Nuevo proveedor</h1>
    </div>
  </div>

  <br>
  <br>

  <form method="POST" action="{{ route('guardarproveedor') }}">
    @csrf
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label col-form-label-lg">Nombre Completo</label>
      <div class="col-sm-8">
        <input type="text" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }} form-control-lg"  placeholder="Ingresa el nombre completo" autocomplete="off" value="{{ old('nombre') }}">

        @if ($errors->has('nombre'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('nombre') }}</strong>
          </span>
        @endif
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label  class="col-sm-2 col-form-label col-form-label-lg">Empresa</label>
      <div class="col-sm-8">
        <input type="text" name="empresa" class="form-control{{ $errors->has('empresa') ? ' is-invalid' : '' }} form-control-lg" placeholder="Ejemplo S.A." autocomplete="off" value="{{ old('empresa') }}">

        @if ($errors->has('empresa'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('empresa') }}</strong>
          </span>
        @endif
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label col-form-label-lg">Teléfono</label>
      <div class="col-sm-8">
        <input type="text" name="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }} form-control-lg" placeholder="7771234567" autocomplete="off" value="{{ old('telefono') }}">

        @if ($errors->has('telefono'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('telefono') }}</strong>
          </span>
        @endif
      </div>
    </div>

    <br>

    <div class="row">
      <div class="col-sm-2"></div>

      <div class="col-sm-4">
        <a class="btn btn-danger btn-block mb-2 btn-lg" href="{{route('proveedores')}}">Cancelar</a>
      </div>

      <div class="col-sm-4">
        <button type="submit" class="btn btn-success btn-block mb-2 btn-lg" >Registrar</button>
      </div>

    </div>

  </form>

      


</div>
@endsection