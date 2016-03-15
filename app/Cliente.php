<?php

namespace course;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clientes';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['razonsocial', 'direccion', 'telefono', 'limite_chp', 'limite_cht', 'tasa_desc', 'tasa_gasto', 'gasto_fijo'];
    
    public function operaciones(){
        return $this->hasMany('course\Operacion','cliente_id','id');
        
    }
    public function cheques(){
        return $this->hasMany("course\Cheque","id_cliente","id");
    }
}
