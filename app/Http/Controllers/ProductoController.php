<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Proveedor;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        //dd($productos);
        return view('Productos.productos', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        return view('Productos.registrar', compact('proveedores'));
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
            'codigo' => 'required',
            'nombre'=> 'required',
            'presentacion' => 'required',
            'presentacion_2' => 'required|notIn:0',
            'proveedor' => 'required|notIn:0',
            'categoria' => 'required|notIn:0',
            'precio_venta'=> 'required',
            'existencias' => 'numeric',
        ]);

        $data = $request->all();

        $producto = new Producto();
        $producto->codigo = $data["codigo"];
        $producto->nombre_producto = $data["nombre"];
        $producto->presentacion = $data["presentacion"] + $data["presentacion_2"];
        $producto->proveedor_id = $data["proveedor"];
        $producto->categoria = $data["categoria"];
        $producto->precio = $data["precio_venta"];
        $producto->existencias = $data["existencias"];
        $res = $producto->save();

        if($res){
            return redirect()->route('productos')->with('success','Se ha registrado un nuevo producto');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $proveedor = Producto::where(['id' => $id])->firstOrFail();
        $proveedor->delete();
        return redirect()->route('productos')->with('warning','Se ha dado de baja el producto seleccionado');
    }
}
