@extends('layouts.app')

@section('content')
<div class="container">
  <br>
  <div class="row">
    <div class="col-sm">
      <h1>Nueva Compra</h1>
    </div>
  </div>

  <br>
  <br>

  <form method="POST" action="{{ route('guardarcompra') }}"enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
      <label  class="col-sm-2 col-form-label col-form-label-lg">Proveedor</label>
      <div class="col-sm-8">
       <select class="form-control{{ $errors->has('proveedor') ? ' is-invalid' : '' }} form-control-lg" name="idproveedor">
       
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
      <label  class="col-sm-2 col-form-label col-form-label-lg">Fecha a pagar</label>
      <div class="col-sm-8">
        <input type="Date" name="fechaapagar" class="form-control{{ $errors->has('fechaapagar') ? ' is-invalid' : '' }} form-control-lg" placeholder="Ejemplo S.A." autocomplete="off" value="{{ old('fechaapagar') }}">

        @if ($errors->has('fechaapagar'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('fechaapagar') }}</strong>
          </span>
        @endif
      </div>
      <span style="color:red">*</span>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label col-form-label-lg">Estado</label>
      <div class="col-sm-8">
        <select class="form-control{{ $errors->has('estado') ? ' is-invalid' : '' }} form-control-lg" name="estado">
          <option  value="-1" selected>Selecciona un Estado de la compra</option>
          <option value="0">Pendiente</option>
          <option value="1">Pagada</option>
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-2 col-form-label col-form-label-lg">Total a pagar</label>
      <div class="col-sm-8">
        <input type="number" name="total" class="form-control{{ $errors->has('total') ? ' is-invalid' : '' }} form-control-lg"  placeholder="Ingresa el total de la compra" autocomplete="off" value="{{ old('total') }}" step="any" min="0">

        @if ($errors->has('total'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('total') }}</strong>
          </span>
        @endif
      </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-2 col-form-label col-form-label-lg">Ingresa el ticket</label>
      <div class="col-sm-8">
        <input type="file" name="archivo" class="form-control-file {{ $errors->has('archivo') ? ' is-invalid' : '' }} form-control-lg"  placeholder="Ingresa el ticket de la compra" autocomplete="off" value="{{ old('archivo') }}" accept="image/*">

        @if ($errors->has('archivo'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('archivo') }}</strong>
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