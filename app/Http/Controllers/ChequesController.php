<?php

namespace course\Http\Controllers;

use course\Http\Requests;
use course\Http\Controllers\Controller;
use course\Chequeventa;
use course\Cheque;
use course\Cuit;
use course\Banco;
use course\Movicheque;
use course\Cliente;
use course\Cartera;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;


class ChequesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cheques = Cheque::orderBy("created_at","desc")->where("estado","cartera")->paginate(5);
        $tot_cartera=Cheque::all()->sum("importe");
        return view('cheques.index', compact('cheques',"tot_cartera"));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $cuits=Cuit::lists('razonsocial','id');
        $bancos=Banco::lists('entidad','id');
        $clientes=Cliente::lists('razonsocial','id');
        $carteras=Cartera::lists('nombre','id');
        return view('cheques.create',compact('cuits','bancos','clientes','carteras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['nrocheque' => 'required',
                                   'importe' => 'required', 'fechavto' => 'required', ]);

        $chequeinsertado = Cheque::create($request->all());
        
        $clien = Cliente::findOrFail($request->id_cliente);
        $clien->acumulado_cht = $clien->acumulado_cht + $chequeinsertado->importe;
        $clien->save();
        
        $movicaja = new Movicheque();
        $neto=0;
        $neto=$chequeinsertado->importe-$chequeinsertado->desctasa-$chequeinsertado->descgasto-$chequeinsertado->descfijo;
        $movicaja->importe = $neto*(-1);
        $movicaja->operacion_id = $chequeinsertado->id;
        $movicaja->concepto_id = 6;
        $movicaja->comentario = "compra cheque nro:".$request->nrocheque;
        $movicaja->save();
        

        \Session::flash('message', 'Cheque Agregado!');

        return redirect('cheques');
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
        $cheque = Cheque::findOrFail($id);

        return view('cheques.show', compact('cheque'));
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
        $cheque = Cheque::findOrFail($id);

        return view('cheques.edit', compact('cheque'));
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
        $this->validate($request, ['nrocheque' => 'required', 'importe' => 'required', 'fechavto' => 'required', ]);

        $cheque = Cheque::findOrFail($id);
        $cheque->update($request->all());

        \Session::flash('message', 'Cheque Modificado!');

        return redirect('cheques');
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
        Cheque::destroy($id);

        \Session::flash('message', 'Cheque Borrado!');

        return redirect('cheques');
    }
    public function venta($id){
        
        $chequeven = Cheque::findOrFail($id);
        $clientes=Cliente::lists('razonsocial','id');
        
        return view("cheques.venta",compact("chequeven","clientes"));
    }
    
    public function grabarVenta(Request $request){
        //$this->validate($request, ['nrocheque' => 'required', 'importe' => 'required', 'fechavto' => 'required', ]);
        
        $chv = Cheque::find($request->id_cheque);
        $chv->estado = "vendido";
        $chv->save();
        
        
        Chequeventa::create($request->all());
        
        $movicaja = new Movicheque();
        $neto=0;
        $neto=$chv->importe-$chv->desctasa-$chv->descgasto-$chv->descfijo;
        $movicaja->importe = $neto;
        $movicaja->operacion_id = $chv->id;
        $movicaja->concepto_id = 7;
        $movicaja->comentario = "venta chequenro:".$chv->nrocheque;
        $movicaja->save();
        
        \Session::flash('message', 'Venta Grabada!');

        return redirect('cheques');
    }
}