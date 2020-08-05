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
        //$productos = Producto::orderBy('id','DESC');
        $productos = Producto::all();
        //dd($productos);
        return view('Productos.productos', compact('productos'));
       /* if($request)
        {
            $query = trim($request->get(key,'buscarProducto'));
            $busqueda = Producto::where("nombre_producto","LIKE","%".$query."%")
            ->orderBy("id","asc")
            ->get();
        return redirect()->route('productos',["busqueda" => $busqueda, "" => $query]);
    
        }*/
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

  /*  public function search(Request $request)
    {
        if($request)
        {
            $query = trim($request->get(key,'buscarProducto'));
            $busqueda = Producto::where("nombre_producto","LIKE","%".$query."%")
            ->orderBy("id","asc")
            ->get();
        return redirect()->route('productos',["busqueda" => $busqueda, "" => $query]);
    
        }
        
    }*/
    /*
    public function search(Request $request){
        $nombres    =   Producto::where("nombre_producto",'like',$request->buscarProducto."%")->take(10)->get();
        return view("Producto",compact("productos"));        
    } */

    public function store(Request $request)
    {
        $this->validate(request(), [//Validacion por parte del servidor
            'codigo' => 'required',
            'nombre_producto'=> 'required',
            'presentacion' => 'required',
            'presentacion_2' => 'required|notIn:0',
            'proveedor' => 'required|notIn:0',
            'categoria' => 'required|notIn:0',
            'precio_venta'=> 'required'
        ]);

        $data = $request->all();

        $producto = new Producto();
        $producto->codigo = $data["codigo"];
        $producto->nombre_producto = $data["nombre_producto"];
        $producto->presentacion = $data["presentacion"];
        $producto->presentacion_2= $data["presentacion_2"];
        $producto->proveedor_id = $data["proveedor"];
        $producto->categoria = $data["categoria"];
        $producto->precio = $data["precio_venta"];

        if ($data["existencias"]==null) {
            $producto->existencias = 0;
        }else{
            $producto->existencias = $data["existencias"];
        }
        
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
        $producto = Producto::findOrFail($id);
        return redirect()->route('productos')->with('success','Encontrado');
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
        $producto = Producto::where(['id' => $id])->firstOrFail();
        return view('Productos.editar', compact('producto'));
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
        //Alert::message('The end is near', 'danger');
        $data = $request->all();
        
        $producto = Producto::where(['id' => $id])->firstOrFail();
     
        $producto->codigo = $data["codigo"];
        $producto->nombre_producto = $data["nombre_producto"];
        $producto->presentacion = $data["presentacion"];
        $producto->presentacion_2= $data["presentacion_2"];
        $producto->proveedor_id = $data["proveedor_id"];
        $producto->categoria = $data["categoria"];
        $producto->precio = $data["precio_venta"];
        $producto->existencias = $data["existencias"];
        $res = $producto->update();
     
        if($res){
            return redirect()->route('productos')->with('success','Se han actualizado los datos del producto');   
        }
        else
        {
            return redirect()->route('productos')->with('ijoles','valio kk xd');  
            
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::where(['id' => $id])->firstOrFail();
        $producto->delete();
        return redirect()->route('productos')->with('warning','Se ha dado de baja el producto seleccionado');
    }

     public function descontinuados()
    {
        
        $productos = Producto::onlyTrashed()->get();
        return view('Productos.productos', compact('productos'));
       
    }
}
