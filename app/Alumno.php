<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumnos';

    public $fillable = [
    	'docide',
        'numerodoc',
        'primernombre',
        'segundonombre',
        'primerapellido',
        'segundoapellido',
        'fechanac',
        'lugarnac',
        'lugarexp',
        'direccion',
        'departamento',
        'municipio',
        'barrio',
        'telefono',
        'acudiente',
        'parentesco',
        'telefonofami',
        'direccionfami'
    ];
}
