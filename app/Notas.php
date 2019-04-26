<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    protected $table = 'notas';

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
