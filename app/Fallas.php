<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fallas extends Model
{
    protected $table = 'fallas';

    public $fillable = [
    	'ano',
    	'periodo',
    	'curso',
    	'numerodoc',
    	'castellano',
        'matematica',
    	'naturales',
    	'sociales',
    	'ingles',
    	'electivas',
    	'comerciales',
        'disciplina',
        'optativa'
    ];
}
