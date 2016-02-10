<?php namespace course;


use Illuminate\Database\Eloquent\Model;


class Operacion extends Model  {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'operaciones';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['moneda','tipo_mov', 'cotizacion','cantidad','importe','cliente_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	
/*	public function scopeName($query , $name){
		if (trim($name)!=""){
			$query->where('name','LIKE',"%$name%");
		}	
	}	
	
*/	
	public function movimientos(){
		return $this->hasOne('course\Movimiento','operacion_id','id');
	}

	public function clientes(){
		return $this->belongsTo('course\Cliente','cliente_id','id');
	}
}
