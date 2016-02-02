<?php

namespace course;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'conceptos';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['concepto', 'signo'];
    
    public function movimientos(){
        return $this->hasMany('course\Movimiento','id','concepto_id');
    }

}
