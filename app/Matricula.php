<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table = 'matricula';

    public $fillable = [
    	'ano',
    	'curso',
    	'codide',
    	'codmatricula',
    	'jornada'
    ];
}
