<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $productos = DB::table('productos')
            ->join('proveedors','productos.proveedor_id','=','proveedors.id')
            ->where('productos.deleted_at','=',null)
            ->select('productos.*','proveedors.empresa')
            ->get();
        $proveedores = Proveedor::all();
        return view('Productos.productos', compact('productos', 'proveedores')) ;
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
        if($producto->existencias == null)
            $producto->existencias = 0;
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

    public function habilitar($id)
    {
        //User::
        $producto = Producto::onlyTrashed()->find($id)->restore();
        //$producto->delete();
        return redirect()->route('productos')->with('warning','Se habilitado nuevamente el producto');
    }

     public function descontinuados()
    {
        $productos = DB::table('productos')
            ->join('proveedors','productos.proveedor_id','=','proveedors.id')
            ->where('productos.deleted_at','!=',null)
            ->select('productos.*','proveedors.empresa')
            ->get();
        $proveedores = Proveedor::all();
        return view('Productos.descontinuados', compact('productos', 'proveedores')) ;
       
    }

    public function buscar(Request $request)
    {

        $nombre = $request["nombre"];
        if($nombre == null)
            $nombre = '°';
        $proveedor = $request["proveedor"]; 
        //dd($proveedor);
        if($proveedor== -1)
            $proveedor = null;

        if($proveedor!=null){
            $productos = DB::table('Productos')
                ->join('proveedors','productos.proveedor_id','=','proveedors.id')
                ->where('productos.nombre_producto','LIKE','%'.$nombre.'%') 
                ->orWhere('productos.proveedor_id','=',$proveedor)
                ->where('productos.deleted_at','=',null)
                ->select('productos.*','proveedors.empresa')
                ->get();
                //dd($productos);
            if(count($productos)<=0){//Hubo resultados mediante el nombre??
                $productos = DB::table('Productos')
                    ->join('proveedors','productos.proveedor_id','=','proveedors.id')
                    ->where('productos.codigo','=', $nombre)
                    ->Where('productos.proveedor_id','=',$proveedor)
                    ->orWhere('productos.proveedor_id',$proveedor)
                    ->where('productos.deleted_at','=',null)
                    ->select('productos.*','proveedors.empresa')
                    ->get();
                
            }    
        }else{
            $productos = DB::table('Productos')
                ->join('proveedors','productos.proveedor_id','=','proveedors.id')
                ->where('productos.nombre_producto','LIKE','%'.$nombre.'%') 
                ->where('productos.deleted_at','=',null)
                ->select('productos.*','proveedors.empresa')
                ->get();
            if(count($productos)<=0){//Hubo resultados mediante el nombre??
                $productos = DB::table('Productos')
                    ->join('proveedors','productos.proveedor_id','=','proveedors.id')
                    ->where('productos.codigo','=', $nombre)
                    ->where('productos.deleted_at','=',null)
                    ->select('productos.*','proveedors.empresa')
                    ->get();
            }    
        }
        if($nombre == '°' and $proveedor == null){
            $productos = Producto::all();
            $productos = DB::table('productos')
                ->join('proveedors','productos.proveedor_id','=','proveedors.id')
                ->where('productos.deleted_at','=',null)
                ->select('productos.*','proveedors.empresa')
                ->get();
        }
        $proveedores = Proveedor::all(); 
        return view('Productos.productos', compact('productos', 'proveedores')) ;    
    }
}
