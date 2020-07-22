<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('Proveedores.proveedores', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Proveedores.registrar');
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
            'nombre' => 'required',
            'empresa'=> 'required',
            'telefono' => 'max:10'
        ]);

        $data = $request->all();

        $proveedor = new Proveedor();
        $proveedor->nombre_proveedor = $data["nombre"];
        $proveedor->empresa = $data["empresa"];
        $proveedor->telefono = $data["telefono"];
        $res = $proveedor->save();

        if($res){
            return redirect()->route('proveedores')->with('success','Se ha registrado un nuevo proveedor');
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
        $proveedor = Proveedor::where(['id' => $id])->firstOrFail();
        return view('Proveedores.editar', compact('proveedor'));
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
        $this->validate(request(), [//Validacion por parte del servidor
            'nombre' => 'required',
            'empresa'=> 'required',
            'telefono' => 'min:10|max:10'
        ]);

        $data = $request->all();

        $proveedor = Proveedor::where(['id' => $id])->firstOrFail();
        $proveedor->nombre_proveedor = $data["nombre"];
        $proveedor->empresa = $data["empresa"];
        $proveedor->telefono = $data["telefono"];
        $res = $proveedor->update();

        if($res){
            return redirect()->route('proveedores')->with('success','Se han actualizado los datos del proveedor');
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
        $proveedor = Proveedor::where(['id' => $id])->firstOrFail();
        $proveedor->delete();
        return redirect()->route('proveedores')->with('warning','Se ha eliminado el proveedor');
    }
}
