<?php

namespace course;

use Illuminate\Database\Eloquent\Model;

class Chequeventa extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chequeven';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_cheque','id_tomador','fechaventa', 'cli_liqui','tasa_descu', 'tasa_gasto', 'descuentofijo', 'descuento', 
                            'gasto','neto'];
    
    public function chequecom(){
        return $this->belongsTo('course\Cheque','id','id_cheque');
    }
    
    public function tomador(){
        return $this->belongsTo('course\clientes','id','id_tomador');
    }
}
