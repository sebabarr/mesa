<?php

namespace course;

use Illuminate\Database\Eloquent\Model;

class Movicheque extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'movicheque';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['concepto_id', 'comentario','importe','operacion_id',];

}
