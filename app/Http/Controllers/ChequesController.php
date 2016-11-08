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
        $movicaja->comentario = "venta cheque nro:".$chv->nrocheque;
        $movicaja->save();
        
        \Session::flash('message', 'Venta Grabada!');

        return redirect('cheques');
    }
    
    
    
        
    
    
     public function imprimircesion($id)
    {
        $cheque = Cheque::find($id);
        $razon = $cheque->cuits->razonsocial;
        $nrocuit = $cheque->cuits->numero;
        $V=new EnLetras();
        $T=new EnLetras();
        
        
        $var_impre=["nrocheque"=>$cheque->nrocheque,"imp"=>$cheque->importe,"fecvto"=>$cheque->fechavto,
                    "cuit"=>$nrocuit,"librador"=>$razon,"banco"=>$cheque->bancos->entidad,
                    "nomcli"=>$cheque->clientes->razonsocial,"dni"=>$cheque->clientes->cuit,
                    "dire"=>$cheque->clientes->direccion,"fechahoy"=>date('d-m-Y'),
                    "fecletra"=>$T->FechaenLetras(date('d-m-Y')),
                    "impletras"=>$V->ValorEnLetras($cheque->importe,"pesos")];
        $view = \View::make('cheques.listados.cesionch', compact('var_impre'))->render();
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
            $cheques=DB::table('cheques')->whereBetween('fechavto',[Input::get('fechadesde'),Input::get('fechahasta')])
                                         ->get();
            /*$cheques=Collection::make($che);*/
           
        } 
        //dd($cheques);
        return view('cheques.buscarcheque', compact('cheques'));
    }
    
    public function t_ing_eng()
    {
        $fd=Input::get("fechad");
        $fh=Input::get("fechah");
        
        $res=DB::table('cheques')
                ->whereBetween('created_at', [$fd,$fh])
                ->get();
                
        $cole=Collection::make($res);
        
        
        $tot_int=$cole->sum('desctasa');
        $tot_gas=$cole->sum('descgasto');
        $tot_otr=$cole->sum('descfijo');
        $tr=$cole->count();
        
        $res1=DB::table('chequeven')
                ->whereBetween('created_at', [$fd,$fh])
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
}
