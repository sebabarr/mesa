<?php

namespace course\Http\Controllers;

use course\Http\Requests;
use course\Http\Controllers\Controller;

use course\Cartera;
use Illuminate\Http\Request; 
use Carbon\Carbon;
use Session;

class CarterasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $carteras = Cartera::paginate(10);

        return view('carteras.index', compact('carteras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('carteras.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['nombre' => 'required', ]);

        Cartera::create($request->all());

        \Session::flash('message', 'Cartera Agregado!');

        return redirect('carteras');
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
        $cartera = Cartera::findOrFail($id);

        return view('carteras.show', compact('cartera'));
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
        $cartera = Cartera::findOrFail($id);

        return view('carteras.edit', compact('cartera'));
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
        $this->validate($request, ['nombre' => 'required', ]);

        $cartera = Cartera::findOrFail($id);
        $cartera->update($request->all());

        \Session::flash('message', 'Cartera Modificado!');

        return redirect('carteras');
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
        Cartera::destroy($id);

        \Session::flash('message', 'Cartera Borrado!');

        return redirect('carteras');
    }

}
