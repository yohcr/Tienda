<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('Clientes.clientes', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Clientes.registrar');
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
            'telefono' => 'required'
        ]);

        $data = $request->all();

        $cliente = new Cliente();
        $cliente->nombre = $data["nombre"];
        $cliente->telefono = $data["telefono"];
        $cliente->cuenta = 0;
        $res = $cliente->save();

        if($res){
            return redirect()->route('clientes')->with('success','Se ha registrado un nuevo cliente');
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
        $cliente = Cliente::find($id);
        return view('Clientes.editar', compact('cliente'));
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
        $data = $request->all();
        $cliente = Cliente::find($id);
        $cliente->nombre = $data["nombre"];
        $res = $cliente->update();
        if($res){
            return redirect()->route('clientes')->with('success','Se han actualizado los datos del producto');
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
        //
    }
    public function buscar(Request $request)
    {
        $nombre = $request["nombre"];
        $clientes = Cliente::where('nombre','LIKE','%'.$nombre.'%')->get();
        return view('Clientes.clientes', compact('clientes'));
    }
}
