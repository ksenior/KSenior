<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familiar extends Model
{
    protected $table = 'familia';
    public $fillable = [
    	'numerodoc',
    	'parentesco',
    	'nombre',
    	'primerapellido',
    	'segundoapellido',
      'tipodoc',
    	'docpadre',
    	'direccion',
    	'ocupacion',
    	'telefono1',
    	'escolaridad',
      'genero'
    ];
}
