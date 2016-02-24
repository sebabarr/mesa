<?php

namespace course;

use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'carteras';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

}
