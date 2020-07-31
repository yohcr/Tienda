@extends('layouts.app')

@section('content')
<div class="container">
  <br>
  <div class="row">
    <div class="col-sm">
      <h1>Nuevo Cliente</h1>
    </div>
  </div>

  <br>
  <br>

  <form method="POST" action="{{ route('guardarcliente') }}">
    @csrf
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label col-form-label-lg">Nombre: </label>
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

    <br>

    <div class="row">
      <div class="col-sm-2"></div>

      <div class="col-sm-4">
        <a class="btn btn-danger btn-block mb-2 btn-lg" href="{{route('clientes')}}">Cancelar</a>
      </div>

      <div class="col-sm-4">
        <button type="submit" class="btn btn-success btn-block mb-2 btn-lg" >Registrar</button>
      </div>

    </div>

  </form>

      


</div>
@endsection