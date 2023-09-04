<?php

namespace App\Http\Controllers;

use App\Events\EventNotification;
use App\Models\Cuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentas = Cuenta::all();
        event(new EventNotification($cuentas));
        return response()->json($cuentas);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
       
    $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|unique:cuentas|max:255',
            'telefono'=> ['string', 'regex:/^[0-9]+$/']
        ]);
    
        if ($validator->fails()) {
        // Si la validación falla, devuelve una respuesta JSON con los errores
        return response()->json(['errors' => $validator->errors()], 422);
    }
    
        $cuenta  = new Cuenta ();
        $cuenta->nombre = $request->nombre;
        $cuenta->email = $request->email;
        $cuenta->telefono = $request->telefono;

        $cuenta->save();
        
        event(new EventNotification($cuenta));
        return response()->json(
           $cuenta       
        );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function show(Cuenta $cuenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuenta $cuenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
       
    
        $cuenta = Cuenta::findOrFail($request->id);
        $cuenta->nombre = $request->nombre ? $request->nombre : $cuenta->nombre;
        $cuenta->email = $request->email ? $request->email : $cuenta->email;
        $cuenta->telefono = $request->telefono ? $request->telefono : $cuenta->telefono;

        $cuenta->save();
        event(new EventNotification($cuenta));
        return response()->json($cuenta, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuenta  $cuenta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Cuenta::destroy($id);
        event(new EventNotification("Eliminado"));
        return response()->json("Eliminado", 200);
    }
}
