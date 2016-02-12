<?php

namespace course\Http\Controllers;

use course\Http\Requests;
use course\Http\Controllers\Controller;

use course\Cuit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class CuitsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
     public function __construct () {
		$this->middleware('auth');
	}
	
    public function index()
    {
        $cuits = Cuit::paginate(15);

        return view('cuits.index', compact('cuits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('cuits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['razonsocial' => 'required|unique:cuits,razonsocial', ]);

        Cuit::create($request->all());
        

        \Session::flash('message', 'Cuit added!');

        return redirect('cuits');
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
        $cuit = Cuit::findOrFail($id);

        return view('cuits.show', compact('cuit'));
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
        $cuit = Cuit::findOrFail($id);

        return view('cuits.edit', compact('cuit'));
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

        $cuit = Cuit::findOrFail($id);
        $cuit->update($request->all());

        \Session::Flash('message', 'Cuit updated!');

        return redirect('cuits');
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
        Cuit::destroy($id);
        \Session::Flash('message', 'Cuit deleted!');

        return redirect('cuits');
    }

}
