<?php

namespace course;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'movimientos';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['concepto_id', 'comentario', 'importe', 'operacion_id'];

    public function conceptos(){
        return $this->belongsTo('course\Concepto','concepto_id','id');
    }
    public function operaciones(){
        return $this->belongsTo('course\Operacion','operacion_id','id');
    }
}
