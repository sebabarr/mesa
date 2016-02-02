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

}
