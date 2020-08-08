<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Compra;
use App\Proveedor;
use App\Detalle_compra;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$compras = Compra::all();
        $compras = DB::table('compras')
            ->join('detalle_compra','compras.producto_id','=','productos.id')
            ->join()
        return view('Compras.compras',compact('compras'));*/
        $compras = DB::table('compras')
            ->join('proveedors','compras.idproveedor','=','proveedors.id')
            ->select('proveedors.empresa','compras.*')
            ->get();
        //dd($compras);
        return view('Compras.compras', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        return view('Compras.registrar', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [//Validacion por parte del servidor
            'idproveedor' => 'required|notIn:0',
            'fechaapagar' => 'required|date',
            'estado' => 'required|notIn:-1',
            'total' => 'required|notIn:0',
            'archivo' => 'required'
        ]);
        $data = $request->all();
        //dd($data);
        //$compra = new Compra();
        //$compra->total = $data["total"];
        //$compra->idproveedor = $data["proveedor"];
        //$compra->estado = $data["estado"];
        //$compra->fechaapagar = $data["fechaapagar"];
        if($archivo=$request->file('archivo')){
            $nombre=$archivo->getClientOriginalName();
            $archivo->move('images', $nombre);
            $data["archivo"]=$nombre;
        }
        Compra::create($data);

        //$res = $compra->save();
        /*$detalle_compra = new Detalle_compra();
        $detalle_compra->producto_id = 1;
        $detalle_compra->cantidad = 1;
        $detalle_compra->subtotal = 1;
        $detalle_compra->compra_id = $compra->id;
        $res2 = $compra->save();*/
        return redirect()->route('compras')->with('success','Se ha registrado una nueva compra');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $compras = DB::table('compras')
            ->join('proveedors', 'compras.idproveedor', '=', 'proveedors.id')
            ->where('compras.id','=',$id)
            ->get();
        //dd($detallecompra);
        return view('Compras.editar',compact('compras'));
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
