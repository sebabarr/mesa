<?php

namespace course\Http\Controllers;

use course\Http\Requests;
use course\Http\Controllers\Controller;

use course\Concepto;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class ConceptoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $concepto = Concepto::paginate(10);

        return view('concepto.index', compact('concepto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('concepto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['concepto' => 'required', 'signo' => 'required', ]);

        Concepto::create($request->all());

        \Session::flash('message', 'Concepto Agregado!');

        return redirect('concepto');
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
        $concepto = Concepto::findOrFail($id);

        return view('concepto.show', compact('concepto'));
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
        $concepto = Concepto::findOrFail($id);

        return view('concepto.edit', compact('concepto'));
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
        $this->validate($request, ['concepto' => 'required', 'signo' => 'required', ]);

        $concepto = Concepto::findOrFail($id);
        $concepto->update($request->all());

        \Session::flash('message', 'Concepto Modificado!');

        return redirect('concepto');
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
        Concepto::destroy($id);

        \Session::flash('message', 'Concepto Borrado!');

        return redirect('concepto');
    }

}
