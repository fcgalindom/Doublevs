<?php

namespace App\Http\Controllers;

use App\Events\EventNotification;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedido = Pedido::all();
        return response()->json($pedido);
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

        $validator = Validator::make($request->all(), [
            'producto' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'valor' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'cuenta_id' => 'required|exists:cuentas,_id',
        ]);
        if ($validator->fails()) {
            // Si la validación falla, devuelve una respuesta JSON con los errores
            return response()->json(['errors' => $validator->errors()], 422);
        }
       
    
        $pedido  = new Pedido ();
        $pedido->producto = $request->producto;
        $pedido->cantidad = $request->cantidad;
        $pedido->valor = $request->valor;
        $pedido->total = $request->total;
        $pedido->cuenta_id = $request->cuenta_id;

        $pedido->save();
        event(new EventNotification($pedido));
        return response()->json(
            $pedido
         );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $pedido = Pedido::findOrFail($request->id);
        $pedido->producto = $request->producto ? $request->producto : $pedido->producto;
        $pedido->cantidad = $request->cantidad  ? $request->cantidad : $pedido->cantidad;
        $pedido->valor = $request->valor  ? $request->valor : $pedido->valor;
        $pedido->total = $request->total  ? $request->total : $pedido->total;
        $pedido->cuenta_id = $request->cuenta_id  ? $request->cuenta_id : $pedido->cuenta_id;
        $pedido->save();
        event(new EventNotification($pedido));
        return response()->json($pedido, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pedido::destroy($id);
        event(new EventNotification("Eliminado"));
        return response()->json("Eliminado", 200);
    }
}
