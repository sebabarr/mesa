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
use course\myclas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Input;
use Illuminate\Support\Collection as Collection;
use Session;
date_default_timezone_set("America/Argentina/cordoba");


class ChequesController extends Controller
{
    
    public function __construct () {
		$this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $cheques = Cheque::orderBy("fechavto","asc")->where("estado","cartera")->paginate(8);
        $tot_cartera=Cheque::all()->where("estado","cartera")->sum("importe");
        $vendidos=Cheque::all()->where("estado","vendido");
        $ff = $vendidos->filter(function($vendido){
                    $var1= date_create($vendido->fechavto);
                    $var2= date_create(date("Y-m-d"));
                    if ($var1 > $var2) {
                        return true;
                    }
                    
                    
        });
        $tot_vendido=$ff->sum("importe");
        return view('cheques.index', compact('cheques',"tot_cartera","tot_vendido"));
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
       // dd($request);
       $grabasen = 0;
        for ($i = 0; $i < 4; $i++) {
            
            /*-----grabar cheques*/
            if ((!empty($request->id_cuit[$i])) and (!empty($request->nrocheque[$i])) and (!empty($request->importe[$i]))) {
                // code
                    $chequeinsertado = new Cheque;
                    $chequeinsertado->nrocheque = $request->nrocheque[$i];
                    $chequeinsertado->id_banco = $request->id_banco[$i];
                    $chequeinsertado->fechavto = $request->fechavto[$i];
                    $chequeinsertado->id_cuit = $request->id_cuit[$i];
                    $chequeinsertado->estado = "cartera";
                    $chequeinsertado->id_cliente = $request->id_cliente;
                    $chequeinsertado->desctasa = $request->desctasa[$i];
                    $chequeinsertado->descgasto = $request->descgasto[$i];
                    $chequeinsertado->descfijo = $request->descfijo[$i];
                    $chequeinsertado->tasa_desc = $request->tasa_desc1;
                    $chequeinsertado->tasa_gast = $request->tasa_gast1;
                    $chequeinsertado->importe = $request->importe[$i];
                    $chequeinsertado->id_cartera = 1;
                    $chequeinsertado->save();
        
                    $clien = Cliente::findOrFail($request->id_cliente);
                    $clien->acumulado_cht = $clien->acumulado_cht + $request->importe[$i];
        
                    $chequeinsertado->cli_ult_liqui=$clien->ult_liqui+1;
                    $chequeinsertado->save();
                    
                    
                    $movicaja = new Movicheque();
                    $neto=0;
                    $neto=$request->importe[$i]-$request->desctasa[$i]-$request->descgasto[$i]-$request->descfijo[$i];
                    $movicaja->importe = $neto*(-1);
                    $movicaja->operacion_id = $chequeinsertado->id;
                    $movicaja->concepto_id = 6;
                    $movicaja->comentario = "compra cheque nro:".$request->nrocheque[$i];
                    $movicaja->save();
                    $grabasen = 1;
            /*fin grabar chequeee----*/
            }
        }
        if ($grabasen = 1) {
            // code...
            $clien->ult_liqui =$clien->ult_liqui+1;
            $clien->save();
            \Session::flash('message', 'Cheques Agregados!');
        }
        
        

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
        $movicaja->comentario = "venta cheque nro:".$chv->nrocheque;
        $movicaja->save();
        
        \Session::flash('message', 'Venta Grabada!');

        return redirect('cheques');
    }
    
    
    public function imprimirCesiones(){
        
        $clientes=Cliente::lists('razonsocial','id');
        
        return View ('cheques.impcesion',compact("clientes"));
    }
        
    
    
     public function imprimircesion(Request $request)
    {
        
        $cheques=DB::table('cheques')
                    ->join('cuits', 'cheques.id_cuit','=','cuits.id')
                    ->join('bancos','cheques.id_banco','=','bancos.id')
                    ->select('cheques.*','cuits.razonsocial','bancos.entidad','cuits.numero')
                    ->where('id_cliente','=',$request->id_cliente)
                    ->Where('cli_ult_liqui','=',$request->nro_liqui)
                    ->get();
       /*dd($cheques);*/
      
        $V=new EnLetras(); // importe en letras
        $T=new EnLetras(); //la fecha en letras
        
       
        $ncheques = Collection::make($cheques);
        $tot_cheques = $ncheques->sum('importe');
        
        $cliente=Cliente::FindorFail($request->id_cliente);
        
        $var_impre=[ "dire"=>$cliente->direccion,
                    "dni"=>$cliente->cuit,
                    "nomcli"=>$cliente->razonsocial,
                    "fechahoy"=>date('d-m-Y'),
                    "fecletra"=>$T->FechaenLetras(date('d-m-Y')),
                    "impletras"=>$V->ValorEnLetras($tot_cheques,"pesos")];
                    
        $view = \View::make('cheques.listados.cesionch', compact('var_impre', 'ncheques'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('cheques.listados.cesionch');
    } 
    
    public function totxcli()
    {   
        $var2= date_create(date("Y-m-d"));
        $res=DB::table('cheques')
                    ->join('clientes', 'cheques.id_cliente','=','clientes.id')
                    ->select('id_cliente', DB::raw('SUM(importe) as total_cliente'),'clientes.razonsocial',DB::raw('SUM(importe) as por_cartera'))
                    ->where('estado','=','cartera')
                    ->orWhere('fechavto','>=',$var2)
                    ->groupBy('id_cliente')
                    ->orderBy('total_cliente','desc')
                    ->get();
        
        $totxclie = Collection::make($res);
      
       
        $totalcartera=$totxclie->sum("total_cliente");
        $totxclie= $totxclie->each(function($item,$key) use ($totalcartera){
                            $por_car=$item->total_cliente/$totalcartera;
                            $item->por_cartera = $por_car;
                            return true;
                            });
          
      
        return \View::make('cheques.totxcliente',compact("totxclie",'totalcartera'));
        
    }
    
    public function totxcuits()
    {
        $var1 = date_create(date("Y-m-d"));
        $res=DB::table('cheques')
                    ->join('cuits', 'cheques.id_cuit','=','cuits.id')
                    ->select('id_cliente', DB::raw('SUM(importe) as total_cuit'),'cuits.razonsocial','cuits.numero as numcuit',DB::raw('SUM(importe) as por_cart'))
                    ->where('estado','=','cartera')
                    ->orWhere('fechavto','>=',$var1)
                    ->groupBy('id_cuit')
                    ->orderBy('total_cuit','desc')
                    ->get();
        
        $totxcuit = Collection::make($res);
      
       
        $totalcartera=$totxcuit->sum("total_cuit");
        $totxcuit= $totxcuit->each(function($item,$key) use ($totalcartera){
                            $por_car=$item->total_cuit/$totalcartera;
                            $item->por_cart = $por_car;
                            return true;
                            });
          
      
        return \View::make('cheques.totxcuits',compact("totxcuit",'totalcartera'));
        
    }
    
    public function tot_ing_eng()
    
    {
        
        return \View::make('cheques.tot_ie');
    }
    
    public function buscarcheque(Request $request)
    {
        $cheques=Cheque::all();
        
        if (Input::get('numche')>0){
            
            $cheques = Cheque::all()->where("nrocheque",intval($request->numche));
        }    
        if ((Input::get('fechadesde'))!=null)  {
            
            
            $collection = Cheque::all()->sortBy('fechavto');
            $cheques = $collection->filter(function ($cheque) use($request) {
            if (($cheque->fechavto >= $request->fechadesde) and ($cheque->fechavto <= $request->fechahasta)){
                return true;
                }
            });
            
        } 
       
        return view('cheques.buscarcheque', compact('cheques'));
    }
    
    public function t_ing_eng()
    {
        $fd=Input::get("fechad");
        $fh=Input::get("fechah");
        
        $res=DB::table('cheques')
                ->where('created_at',">=",$fd)
                ->where('created_at',"<=",$fh)
                ->get();
                
        $cole=Collection::make($res);
        
        
        $tot_int=$cole->sum('desctasa');
        $tot_gas=$cole->sum('descgasto');
        $tot_otr=$cole->sum('descfijo');
        $tr=$cole->count();
        
        $res1=DB::table('chequeven')
                ->where('created_at',">=",$fd)
                ->where('created_at',"<=",$fh)
                ->get();
                
        $cole1=Collection::make($res1);
        $tot_pag=$cole1->sum('descuento');
        $tot_pag_gas=$cole1->sum('gasto');
        $tot_pag_df=$cole1->sum('descuentofijo');
        
        
       return response()->json(['tot_int' => $tot_int,
                                'tot_gas' => $tot_gas,
                                'tot_otr' => $tot_otr,
                                'tot_pag' => $tot_pag,
                                'tot_pag_gas'=>$tot_pag_gas,
                                'tr'=> $tr,
                                'tot_pag_desf'=>$tot_pag_df ]);
       
    }
    
    public function bussalcli(){
        
        $cli=Input::get("cliente");
        
        $cli_datos=Cliente::FindOrFail($cli);
       
        
        
        $res=DB::table('cheques')
                ->where('fechavto',">=",date("m-d-Y"))
                ->where('id_cliente',"=",$cli)
                ->sum('importe');
        
        
        $sal_cli_dis=$cli_datos->limite_cht-$res;
        
        return response()->json(['sal_disp' => $sal_cli_dis,
                                'cli_tasa'=>$cli_datos->tasa_desc,
                                'cli_tasag'=>$cli_datos->tasa_gasto,
                                'cli_tasaf'=>$cli_datos->gasto_fijo
                                
                                ]);
    }
    
    public function bussalcuit(){
        
        $cuit_datos=Cuit::findOrFail(Input::get("cuit"));
        $sumacuit=DB::table('cheques')
                ->where('fechavto',">=",date("m-d-Y"))
                ->where('id_cuit',"=",Input::get("cuit"))
                ->sum('importe');
        
        $sal_cuit_dis=$cuit_datos->limite-$sumacuit;        
        
        return response()->json(['sal_disp_cuit' => $sal_cuit_dis,
                                ]);        
        
    }
    
    public function FiltrarCheques(Request $request){
        
        
        $clientes =  ['' => 'Todos...'] + Cliente::lists('razonsocial','id')->all();
        $cuits=['' => 'Todos...']+ Cuit::lists("razonsocial","id")->all();
        return View('cheques.filtrarcheques',compact('clientes',"cuits"));    
        
    }    
    
    public function imprimirCheques(Request $request ) {
      // dd($request);
        //$cheques=DB::table('cheques')
        //            ->orderBy('fechavto')
        //            ->where('nrocheque',"=",$request->numero)
        //            ->orWhere('fechavto',"=",$request->fecvto)
        //            ->orWhere('id_cuit',"=",$request->cuit)
        //            ->orWhere('id_cliente','=',$request->cliente)
        //            ->get();
        setlocale(LC_MONETARY,"es_ES");
        $mcheques = Cheque::all()->where("estado","cartera")
                                 ->sortBy("fechavto");
                                 
        
        //$mcheques= $mche->filter(function ($value) {
        //        return $value > 2;
        //        });
        //$mcheques = Collection::make($cheques);
        $totalcheques = $mcheques->sum("importe");
        $totalnroche = $mcheques->count();
        $view = \View::make('cheques.listados.listacheques', compact('mcheques',"totalcheques","totalnroche"))->render();
        $pdf = \App::make('snappy.pdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('cheques.listados.listacheques');
        return view('cheques.listados.listacheques',compact('mcheques'));
        
        
    }
    
    
}
