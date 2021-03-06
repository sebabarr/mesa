<?php

namespace course;

use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cheques';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nrocheque', 'importe', 'id_banco', 'fechavto', 'id_cuit', 'estado', 'id_cliente', 'cli_ult_liqui','id_cartera', 'desctasa', 
                           'descgasto', 'descfijo','tasa_desc','tasa_gast'];
    
    public function cuits(){
        return $this->belongsTo('course\Cuit','id_cuit','id');
    }
    public function cheque_ven(){
        return $this->hasOne('course\Chequeventa','id_cheque','id');
    }
    public function clientes(){
        return $this->belongsTo('course\Cliente','id_cliente','id');
    }
    public function bancos(){
        return $this->belongsTo('course\Banco','id_banco','id');
    }   
}