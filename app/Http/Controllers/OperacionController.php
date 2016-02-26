<?php namespace course\Http\Controllers;

use course\Http\Requests;
use course\Http\Controllers\Controller;
use course\Operacion;
use Illuminate\Http\Request;
use course\Cliente;
use course\Movimiento;
use Illuminate\Support\Collection as Collection;

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
		
		$dolar = $oper->where('moneda','Dolar');
		
 		$euro = $oper->where('moneda','Euro');

 		$real = $oper->where('moneda','Real');
 		
 		
		$total_dolar=$dolar->sum("cantidad");
		
		//promedio ponderado
			global $tot_dolcompras,$tot_dolventas,$tot_eurocompras,$tot_euroventas,$tot_realcompras,$tot_realventas; 
			
			$dolarcompras=$dolar->where('tipo_mov','compra');
			$dolarventas=$dolar->where('tipo_mov','venta');
			
			$tot_dolcompras=$dolarcompras->sum('cantidad');
			$tot_dolventas=abs($dolarventas->sum('cantidad'));
		
			$nuevacolecompra=$dolarcompras->map(function ($item, $key) {
				global $tot_dolcompras;
				
				$item['cotizacion'] = (abs($item['cantidad'])/$tot_dolcompras)*$item['cotizacion'];
				
			   return $item ;
			});
			$nuevacoleventa=$dolarventas->map(function ($item, $key) {
				global $tot_dolventas;
				
				$item['cotizacion'] = (abs($item['cantidad'])/$tot_dolventas)*$item['cotizacion'];
				
			   return $item ;
			});
			$prom_dolcompras=$nuevacolecompra->sum('cotizacion');
			$prom_dolventas=$nuevacoleventa->sum('cotizacion');

		//fin promedio dolar
		
		$total_euro=$euro->sum("cantidad");
		//Sacar Promedio euro
			
			$eurocompras=$euro->where('tipo_mov','compra');
			$euroventas=$euro->where('tipo_mov','venta');
			
			
			$tot_eurocompras=$eurocompras->sum('cantidad');
			$tot_euroventas=abs($euroventas->sum('cantidad'));
			
			$nuevacolecompra=$eurocompras->map(function ($item, $key) {
				global $tot_eurocompras;
				
				$item['cotizacion'] = (abs($item['cantidad'])/$tot_eurocompras)*$item['cotizacion'];
				
			   return $item ;
			});
			$nuevacoleventa=$euroventas->map(function ($item, $key) {
				global $tot_euroventas;
				
				$item['cotizacion'] = (abs($item['cantidad'])/$tot_euroventas)*$item['cotizacion'];
				
			   return $item ;
			});
			$prom_eurocompras=$nuevacolecompra->sum('cotizacion');
			$prom_euroventas=$nuevacoleventa->sum('cotizacion');
		

		//fin promedio euro
		
		$total_real=$real->sum("cantidad");
		//Sacar Promedio
			$realcompras=$real->where('tipo_mov','compra');
			$realventas=$real->where('tipo_mov','venta');
			
			
			$tot_realcompras=$realcompras->sum('cantidad');
			$tot_realventas=abs($realventas->sum('cantidad'));
			
			$nuevacolecompra=$realcompras->map(function ($item, $key) {
				global $tot_realcompras;
				
				$item['cotizacion'] = (abs($item['cantidad'])/$tot_realcompras)*$item['cotizacion'];
				
			   return $item ;
			});
			$nuevacoleventa=$realventas->map(function ($item, $key) {
				global $tot_realventas;
				
				$item['cotizacion'] = (abs($item['cantidad'])/$tot_realventas)*$item['cotizacion'];
				
			   return $item ;
			});
			$prom_realcompras=$nuevacolecompra->sum('cotizacion');
			$prom_realventas=$nuevacoleventa->sum('cotizacion');
		

		//fin promedio real
		
		$total_pesos=$oper->sum('importe');
		$ult_com=$operaciones->where('tipo_mov','compra')->where('moneda','Dolar')->sortBy('created_at')->first();
		$ult_ven=$operaciones->where('tipo_mov','venta')->where('moneda','Dolar')->sortBy('created_at')->last();
		$ult_predol_com=$ult_com->cotizacion;
		$ult_predol_ven=$ult_ven->cotizacion;
		
		return view('operaciones.opindex',compact('operaciones','total_dolar','total_euro','total_real','total_pesos','prom_eurocompras',
					'prom_euroventas','prom_realcompras','ult_predol_com','ult_predol_ven','prom_realventas','prom_dolcompras','prom_dolventas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$cliente=Cliente::lists('razonsocial','id');
		return view('operaciones.opcreate',compact('cliente'));
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
					  'cliente_id'=>'required',
					  'cantidad'=>'numeric');
		$this->validate($request,$reglas);
		$nuevo= new Operacion($request->all());
		$nuevo_mov= new Movimiento();
		$comen=$nuevo->tipo_mov."-".$nuevo->moneda."-".$nuevo->cantidad."*$".$nuevo->cotizacion;
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
			$nuevo_mov->concepto_id=4;
			$nuevo_mov->comentario=$comen;
			$nuevo_mov->importe=$nuevo->importe;
		}
		if ($nuevo->tipo_mov=="venta") {
			$nuevo->importe= $nuevo->cantidad*$nuevo->cotizacion;
			$nuevo->cantidad=$nuevo->cantidad*(-1);
			$nuevo_mov->concepto_id=5;
			$nuevo_mov->comentario=$comen;
			$nuevo_mov->importe=$nuevo->importe;					
			
		}
		
		
		$nuevo->save();
		if ($nuevo->tipo_mov=='compra' or $nuevo->tipo_mov=='venta'){
			$nuevo_mov->operacion_id=$nuevo->id;
			$nuevo_mov->save();
		}
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
		$cliente=Cliente::lists('razonsocial','id');
		return view('operaciones.opedit',compact('operacion','cliente'));
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
		$delmov = $operacion->movimientos()->delete();
		\Session::Flash('message','La Operacion fue eliminada');
		return redirect()->route('operacion.index');
	}
	
	public function estadisticas(){
		
		$totxcli = \DB::table('operaciones')
					 ->join('clientes', 'operaciones.cliente_id', '=', 'clientes.id')
                     ->select('cliente_id','tipo_mov','cantidad',\DB::raw('SUM(cantidad) as totxcli'),'clientes.razonsocial') 
                     ->groupBy('cliente_id','tipo_mov')
                     ->orderBy('totxcli')
                     ->paginate(5);
		
	return view('operaciones.estadisticas.ope_estadisticas',compact('totxcli'));
	}
}