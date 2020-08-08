@extends('layouts.app')

@section('content')
<div class="container">
  <br>
  <h1>Nueva venta</h1>

  <div class="row">
 
  <br>
  <br>

  <div class="col-sm-4">


<!--     <form> -->
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 col-form-label col-form-label-lg">Cliente:</label>
        <div class="col">
          <select id="cliente" class="form-control{{ $errors->has('cliente') ? ' is-invalid' : '' }}" name="producto">

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
          <select id="producto" class="form-control{{ $errors->has('producto') ? ' is-invalid' : '' }}" name="producto">

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
          <input id="cantidad" placeholder="1" type="number" name="cantidad" class="form-control" min="1">
        </div>
      </div>
      
      <br>

      <div class="form-group">
        <div class="col">
          <button disabled="true" id="agregar" class="form-control btn btn-info btn-block mb-2 ">Agregar </button>
        </div>
      </div>
      <div class="form-group">
        <div class="col">
          <a href="{{route('ventas')}}" class="form-control btn btn-danger btn-block mb-2 "> Cancelar</a>
        </div>
      </div>

<!--    </form> -->
  </div>

  <div class="col-sm-8">
    <table id="tablaventa" class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Producto</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Subtotal</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <!--<form>-->
          <tbody>
          </tbody>
          <!--<div class="form-group row">
            <select class="form-control" name="estado" id="estadoPago">
              <option value="0">Pagado</option>
              <option value="1">Pendiente de Pago</option>
            </select>
            <div class="col-sm-10">
                <button class="btn btn-info " id="registrarVenta">Registrar</button>
            </div>
          </div>
      </form>-->
    </table>
    <form id="formulario" method="POST" action="{{ route('guardarventa') }}">
      @csrf
      <input type="hidden" id="cliente" name="cliente_id" value="0">
      <input type="hidden" id="totalCuenta" name="total" value="00.00" class="form-control-plaintext form-control-lg">
      <input type="hidden" id="terminar" class="form-control btn btn-info btn-block mb-2 " value="Terminar venta">
    </form>
    
  </div>

</div>

</div>
@endsection

@section('script')

<script>
    $(document).ready(function() {

      const productos = {!! json_encode($productos) !!};
      

      console.log('el documento está preparado');
      var clienteid, productoid, productoseleccionado;
      var cliente, producto, cantidad;
      var ban1=0,ban2=0,ban3=0;
      cont = 1;
      total = 0;

      $('select#cliente').on('change',function(){
          clienteid = $(this).val();
          cliente = $('#cliente option:selected').text();
          console.log(cliente);
          if(clienteid!=0)
            $("input#cliente").val(clienteid);
            ban1=1;

      });

      $('select#producto').on('change',function(){
          productoid = $(this).val();
          producto = $('#producto option:selected').text();
          if(productoid!=0)
            ban2=1;
          //productoseleccionado = productos[productoid-1]
          //console.log(productoseleccionado.nombre_producto*cantidad);
          //$(this).val();
          //alert(cliente);
      });

      $('input#cantidad').on('change',function(){
          cantidad = $('#cantidad').val();
          ban3=1;
          //console.log(productoseleccionado.nombre_producto*cantidad);
          //$(this).val();
          //alert(cliente);
      });

      $(document).on('change', '#cliente,#producto,#cantidad', function() {
        if(ban1==1 && ban2==1 && ban3==1)
          $('#agregar').prop('disabled',false);
          
        });
          
      $('#agregar').on("click",function(){
          agregar();
      });

      

      function agregar(){
        
        productoseleccionado = productos[productoid-1]
        console.log(productoseleccionado);
        console.log(productoseleccionado.precio);
        subtotal = parseFloat(productoseleccionado.precio)*cantidad;

        var fila= document.createElement("tr");
        fila.setAttribute("id", cont);

        var numProducto_celda = document.createElement("td");
        var nomProducto_celda =  document.createElement("td");
        var cantProducto_celda = document.createElement("td");

        var cantProducto_input = document.createElement("input");
        cantProducto_input.setAttribute("class", "form-control cant");
        cantProducto_input.setAttribute("type","number");
        cantProducto_input.setAttribute("value",cantidad);
        cantProducto_input.setAttribute("min", 1);
        cantProducto_input.setAttribute("id", "cantidad_"+cont);


        var codigoProducto = document.createElement("input");
        codigoProducto.setAttribute("type","hidden");
        codigoProducto.setAttribute("value",productoseleccionado.id);
        codigoProducto.setAttribute("class","form-control");
        codigoProducto.setAttribute("id","codigo_"+cont);

        var subtotal_celda = document.createElement("td");
        subtotal_celda.setAttribute("id","subtotal_"+cont);

        var acciones_celda = document.createElement("td");
        var quitarProducto_boton = document.createElement("button");
        quitarProducto_boton.setAttribute("class","btn btn-danger quitar")
        quitarProducto_boton.append("X");
        quitarProducto_boton.setAttribute("id","quitar_"+cont);
        
        //Agregar el numero de producto
        numProducto_celda.append(cont);
        nomProducto_celda.append(producto);
        cantProducto_celda.append(cantProducto_input);
        subtotal_celda.append("$ "+subtotal);
        acciones_celda.append(quitarProducto_boton);
        acciones_celda.append(codigoProducto);

        fila.append(numProducto_celda, nomProducto_celda, cantProducto_celda, subtotal_celda, acciones_celda);
        $('#tablaventa').append(fila);

        total = total + subtotal;
        $('input#totalCuenta').val("$"+total)
            .prop("type","text");
        
        $('<input />').attr('type', 'hidden')
             .attr('id',"productoInput_"+cont)
             .attr('name', "producto_id[]")
             .attr('value', productoid)
             .appendTo('#formulario');

        $('<input />').attr('type', 'hidden')
             .attr('id',"cantidadInput_"+cont)
             .attr('name', "cantidad[]")
             .attr('value', cantidad)
             .appendTo('#formulario');

        $('<input />').attr('type', 'hidden')
             .attr('id',"subtotalInput_"+cont)
             .attr('name', "subtotal[]")
             .attr('value', subtotal)
             .appendTo('#formulario');

        //Resetear los input y select y deshabilitar el de agregar
        $('select#producto').val(0);
        $('input#cantidad').val('');
        $('#agregar').prop('disabled',true);
        $('#terminar').prop('type',"submit");
         cont++;

      }

      //Detecta cuando cambia algo de la tabla de venta
      $("#tablaventa").on("mouseover",".cant", function(){
          console.log("cambio la cantidad");
          $(".cant").change(function(){
              //Obtiene la nueva cantidad 
              nuevaCantidad = $(this).val();
              //Obtenemos el id para saber que fila es
              fila = $(this).attr("id");
              //Obtenemos el numero de fila
              fila = fila.split('_')[1];
              //console.log(id);
              idProd = parseInt($("#codigo_"+fila).val());
              //obtiene el subtotal de ese producto
              subtotalAux = $("#subtotal_"+fila).text();
              subtotalAux = subtotalAux.split(' ')[1];
              subtotalAux = parseFloat(subtotalAux);
              console.log(subtotalAux);
              productoAux = productos[idProd-1];
              precioAux = parseFloat(productoAux.precio);
              nuevoSubtotal = nuevaCantidad*precioAux;
              console.log(nuevoSubtotal);
              total = total - subtotalAux;
              total = total + nuevoSubtotal;
              $("#subtotal_"+fila).text("$ "+total);
              $("input#cantidadInput_"+fila).val(nuevaCantidad);
              $("input#subtotalInput_"+fila).val(nuevoSubtotal);
              
              $('input#totalCuenta').val("$"+total)
                  .prop("type","text");
          });
      });

      //Detecta cuando esta sobre la tabla y agregar el evento de click al boton
      $("#tablaventa").on("mouseover", ".quitar", function(){
          $(".quitar").on("click",function(){
              fila = $(this).attr("id");
              fila = fila.split('_')[1];
              console.log("SE VA A QUITAR ESTA FILA: "+fila);
              subtotalAux = $("#subtotal_"+fila).text();
              subtotalAux = subtotalAux.split(' ')[1];
              subtotalAux = parseFloat(subtotalAux);
              total = total - subtotalAux;

              $('input#totalCuenta').val("$"+total)
                  .prop("type","text");

              tabla = document.getElementById("tablaventa")
              tabla.deleteRow(fila);
              cont = cont-1;
              if(cont==1){
                $('#terminar').prop('type',"hidden");
              }

              $("input#productoInput_"+fila).remove();
              $("input#cantidadInput_"+fila).remove();
              $("input#subtotalInput_"+fila).remove();
          });
      })

      
        
    });
      

</script>

@endsection