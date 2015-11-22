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
	protected $fillable = ['moneda','comprador','vendedor', 'tipo_mov', 'cotizacion','importe','monto'];

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

}
