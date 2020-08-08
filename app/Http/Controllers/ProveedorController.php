<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use Carbon\Carbon;

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
        $proveedor->dia_visita = $data["dia_visita"];
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
            'telefono' => 'max:10'
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

    public function buscar(Request $request)
    {
        $nombre = $request["nombre"];
        $proveedores = Proveedor::where('nombre_proveedor','LIKE','%'.$nombre.'%')->get();
        return view('Proveedores.proveedores', compact('proveedores'));
    }

    public function buscarPorDia()
    {
        $dia = Carbon::now();
        $day = Carbon::parse($dia)->format('l');
        switch ($day) {
            case 'Monday':
                $day = 'Lunes';
                break;
            case 'Tuesday':
                $day = 'Martes';
                break;
            case 'Wednesday':
                $day = 'Miercoles';
                break;
            case 'Thursday':
                $day = 'Jueves';
                break;
            case 'Friday':
                $day = 'Viernes';
                break;
            case 'Saturday':
                $day = 'Sabado';
                break;
            case 'Sunday':
                $day = 'Domingo';
                break;
            default:
                $day = 'None';
                break;
        }
        //dd($day);
        $proveedores = Proveedor::where('dia_visita','=',$day)->get();
        return view('Proveedores.proveedores', compact('proveedores'));
    }

}
