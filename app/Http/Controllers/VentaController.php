<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Producto;
use App\Venta;
use App\Cliente;
use Carbon\Carbon;
use App\detalle_venta;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$ventas = Venta::all();
        $ventas = DB::table('ventas')
            ->join('clientes', 'ventas.cliente_id', '=', 'clientes.id')
            ->select('ventas.*', 'clientes.nombre')
            ->get();
        return view('Ventas.ventas',compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::all();
        $clientes = Cliente::all();
        return view('Ventas.registrar', compact('productos','clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $data = $request->all();
       //dd($data);
       $venta = new Venta();
       $venta->cliente_id = $data["cliente_id"];
       $venta->total = substr($data["total"], 1);
       $venta->save();

       $productos = $data["producto_id"];
       $cant = count($productos);
       $cantidad = $data["cantidad"];
       $subtotal = $data["subtotal"];
       //dd($subtotal);
       //dd($productos[0]);

       for ($i=0; $i < $cant; $i++) {
        //dd($i);
           $detalleventa = new detalle_venta();
           $detalleventa->producto_id = $productos[$i];
           $detalleventa->cantidad = $cantidad[$i];
           $detalleventa->subtotal = $subtotal[$i];
           $detalleventa->venta_id = $venta->id;
           $detalleventa->save();
           //dd($detalleventa);
           $producto = Producto::where(['id' => $productos[$i]])->firstOrFail();
           $cant = $producto->existencias;
           $cant = $cant - $detalleventa->cantidad;
           $producto->existencias = $cant;
           $producto->save();
       }
      for ($i=0; $i<$cant; $i++) {
        $detalleventa = new detalle_venta();
        $detalleventa->producto_id = $productos[$i];
        $detalleventa->cantidad = $cantidad[$i];
        $detalleventa->subtotal = $subtotal[$i];
        $detalleventa->venta_id = $venta->id;
        //dd($detalleventa->producto_id, $detalleventa->cantidad, $detalleventa->subtotal, $detalleventa->venta_id);
        if($detalleventa->save()){
        }else{
          dd("Detalle NO Registrado.");
        }
        //dd($detalleventa);
        $producto = Producto::where(['id' => $productos[$i]])->firstOrFail();
        $cant2 = $producto->existencias;
        $cant2 = $cant2 - $detalleventa->cantidad;
        $producto->existencias = $cant2;
        $producto->save();
      }
        return redirect()->route('ventas')->with('success','Se ha registrado la venta');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$detalleventa = detalle_venta::where('venta_id', $id)->get();
        $detalleventa = DB::table('detalle_ventas')
                ->join('productos', 'detalle_ventas.producto_id','=','productos.id')
                ->where('detalle_ventas.venta_id','=',$id)
                ->select('detalle_ventas.*','productos.*')
                ->get();
        //dd($detalleventa);

        $ventas = DB::table('ventas')
            ->join('clientes', 'ventas.cliente_id', '=', 'clientes.id')
            ->where('ventas.id','=', $id)
            ->select('ventas.*', 'clientes.*')
            ->get();
        //dd($detalleventa);
        
        return view('Ventas.editar',compact('detalleventa','ventas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buscarFecha(Request $request){
        $data = $request->all();
        $fecha = $data["fecha"];
        //dd($fecha);
        $ventas = DB::table('ventas')
            ->join('clientes', 'ventas.cliente_id', '=', 'clientes.id')
            ->where('ventas.created_at','LIKE', '%'.$fecha.'%') 
            ->select('ventas.*','clientes.nombre')
            ->get();
        //dd($ventas);  
        return view('Ventas.ventas',compact('ventas'));
    }
}
