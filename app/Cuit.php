<?php

namespace course;

use Illuminate\Database\Eloquent\Model;

class Cuit extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cuits';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['razonsocial', 'numero', 'limite'];
    
    public function cheques(){
        return $this->hasMany('course\cheque','id','id_cuit');
    }
    public function scopeName($query , $name){
		if (trim($name)!=""){
			$query->where('razonsocial','LIKE',"%$name%");
		}	
	}
}
