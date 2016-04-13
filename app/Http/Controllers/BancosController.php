<?php

namespace course\Http\Controllers;

use course\Http\Requests;
use course\Http\Controllers\Controller;

use course\Banco;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class BancosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $bancos = Banco::name($request->get('name'))->orderBy("entidad","asc")->paginate(7);

        return view('bancos.index', compact('bancos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('bancos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['entidad' => 'required', 'codigo' => 'required', ]);

        Banco::create($request->all());

        \Session::flash('message', 'Banco Agregado!');

        return redirect('bancos');
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
        $banco = Banco::findOrFail($id);

        return view('bancos.show', compact('banco'));
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
        $banco = Banco::findOrFail($id);

        return view('bancos.edit', compact('banco'));
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
        $this->validate($request, ['entidad' => 'required', 'codigo' => 'required', ]);

        $banco = Banco::findOrFail($id);
        $banco->update($request->all());

        \Session::flash('message', 'Banco Modificado!');

        return redirect('bancos');
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
        Banco::destroy($id);

        \Session::flash('message', 'Banco Borrado!');

        return redirect('bancos');
    }

}
