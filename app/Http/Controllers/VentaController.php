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
            ->select('ventas.*', 'clientes.*')
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
        //
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

        $ventas = DB::table('ventas')
            ->join('clientes', 'ventas.cliente_id', '=', 'clientes.id')
            ->where('ventas.id','=', $id)
            ->select('ventas.*', 'clientes.*')
            ->get();
        
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
}
