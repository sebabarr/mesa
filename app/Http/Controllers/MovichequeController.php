<?php

namespace course\Http\Controllers;

use course\Http\Requests;
use course\Http\Controllers\Controller;

use course\Movicheque;
use course\Concepto;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class MovichequeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $movimientos = Movicheque::orderBy('created_at','desc')->paginate(10);
        $saldo=Movicheque::sum('importe');
       
        return view('movicheques.index',compact('movimientos','saldo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $concepto=Concepto::lists('concepto','id');
        return view('movicheques.create',compact('concepto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Movicheque::create($request->all());

        \Session::flash('message', 'movimiento Agregado!');

        return redirect('movicheques');
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
        $movimiento = Movicheque::findOrFail($id);

        return view('movicheques.show', compact('movimiento'));
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
        $movimiento = Movicheque::findOrFail($id);

        return view('movicheques.edit', compact('movimiento'));
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
        
        $movimiento = Movicheque::findOrFail($id);
        $movimiento->update($request->all());

        \Session::flash('message', 'movimiento Modificado!');

        return redirect('movicheques');
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
        Movicheque::destroy($id);

        \Session::flash('message', 'movimiento Borrado!');

        return redirect('movicheques');
    }

}
