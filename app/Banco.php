<?php

namespace course;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bancos';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['entidad', 'codigo'];

}
