<?php

namespace course\Http\Controllers;

use course\Http\Requests;
use course\Http\Controllers\Controller;

use course\Movimiento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class MovimientosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $movimientos = Movimiento::paginate(10);
        $saldo=Movimiento::sum('importe');
        
        return view('movimientos.index', compact('movimientos','saldo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('movimientos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Movimiento::create($request->all());

        \Session::flash('message', 'movimiento Agregado!');

        return redirect('movimientos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $movimiento = Movimiento::findOrFail($id);

        return view('movimientos.show', compact('movimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $movimiento = Movimiento::findOrFail($id);

        return view('movimientos.edit', compact('movimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        
        $movimiento = Movimiento::findOrFail($id);
        $movimiento->update($request->all());

        \Session::flash('message', 'movimiento Modificado!');

        return redirect('movimientos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        Movimiento::destroy($id);

        \Session::flash('message', 'movimiento Borrado!');

        return redirect('movimientos');
    }

}
