<?php namespace course\Http\Controllers;

use course\Http\Requests;
use course\Http\Controllers\Controller;
use course\Operacion;
use Illuminate\Http\Request;

class OperacionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 public function __construct () {
		$this->middleware('auth');
	}
	
	public function index(Request $request) {
	
		$operaciones=Operacion::orderBy('created_at',"desc")->paginate(5);
		$oper=Operacion::all();
		
		$dolar = $oper->filter(function($op) {
    		if ($op->moneda == 'Dolar') {
    			return true;
    		}
 		});
 		$euro = $oper->filter(function($op) {
    		if ($op->moneda == 'Euro') {
    			return true;
    		}
 		});
 		$real = $oper->filter(function($op) {
    		if ($op->moneda == 'Real') {
    			return true;
    		}
 		});
 

		
		
		$total_dolar=$dolar->sum("importe");
		$total_euro=$euro->sum("importe");
		$total_real=$real->sum("importe");
		$total_pesos=$oper->sum('importe');
		return view('operaciones.opindex',compact('operaciones','total_dolar','total_euro','total_real','total_pesos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('operaciones.opcreate');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$reglas=array('moneda'=>'required',
					  'tipo_mov'=>'required',
					  'cotizacion'=>'numeric',
					  'cantidad'=>'numeric');
		$this->validate($request,$reglas);
		$nuevo= new Operacion($request->all());
		if ($nuevo->tipo_mov=="retiro") {
			$nuevo->cantidad=$nuevo->cantidad*(-1);
			$nuevo->importe=0.00;
		}
		if ($nuevo->tipo_mov=="retiro" or $nuevo->tipo_mov=="aporte") {
			$nuevo->cotizacion=0.00;
			$nuevo->importe=0.00;
		}
		if ($nuevo->tipo_mov=="compra") {
			$nuevo->importe=$nuevo->cantidad*$nuevo->cotizacion*(-1);
		}
		if ($nuevo->tipo_mov=="venta") {
			$nuevo->importe= $nuevo->cantidad*$nuevo->cotizacion;
			$nuevo->cantidad=$nuevo->cantidad*(-1);
			
		}
		$nuevo->save();
		return \Redirect::route('operacion.index');
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$operacion=Operacion::FindOrFail($id);
		return view('operaciones.opedit',compact('operacion'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$nuevo=Operacion::FindOrFail($id);
		$reglas=array('tipo_mov'=>'required',
					  'cotizacion'=>'numeric',
					  'moneda'=>'required',
					  'cantidad'=>'numeric');
		$this->validate($request,$reglas);
		$nuevo->fill(\Request::all());
		if ($nuevo->tipo_mov=="retiro") {
			$nuevo->cantidad=$nuevo->cantidad*(-1);
			$nuevo->importe=0.00;
		}
		if ($nuevo->tipo_mov=="retiro" or $nuevo->tipo_mov=="aporte") {
			$nuevo->cotizacion=0.00;
			$nuevo->importe=0.00;
		}
		if ($nuevo->tipo_mov=="compra") {
			$nuevo->importe=$nuevo->cantidad*$nuevo->cotizacion*(-1);
		}
		if ($nuevo->tipo_mov=="venta") {
			$nuevo->importe= $nuevo->cantidad*$nuevo->cotizacion;
			$nuevo->cantidad=$nuevo->cantidad*(-1);
			
		}
		$nuevo->save();
		return \Redirect::route('operacion.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$operacion=Operacion::FindOrFail($id);
		$operacion->delete();
		\Session::Flash('message','La Operacion fue eliminada');
		return redirect()->route('operacion.index');
	}

}
