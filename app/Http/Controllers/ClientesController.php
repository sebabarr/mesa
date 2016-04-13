<?php

namespace course\Http\Controllers;

use course\Http\Requests;
use course\Http\Controllers\Controller;

use course\Cliente;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class ClientesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
     public function __construct () {
		$this->middleware('auth');
	}
    public function index(Request $request)
    {
        $clientes = Cliente::name($request->get('name'))->orderBy("razonsocial","asc")->paginate(7);
      
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['razonsocial' => 'required|unique:clientes', ]);

        Cliente::create($request->all());

        \Session::flash('message', 'Cliente Agregado!');

        return redirect('clientes');
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
        $cliente = Cliente::findOrFail($id);

        return view('clientes.show', compact('cliente'));
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
        $cliente = Cliente::findOrFail($id);

        return view('clientes.edit', compact('cliente'));
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
        $this->validate($request, ['razonsocial' => 'required', ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());

        \Session::flash('message', 'Cliente Modificado!');

        return redirect('clientes');
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
        Cliente::destroy($id);

        \Session::flash('message', 'Cliente Borrado!');

        return redirect('clientes');
    }

}
