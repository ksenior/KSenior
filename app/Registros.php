<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registros extends Model
{
    protected $table = 'registros';

    public $fillable = [
    	'ano',
        'curso',
        'periodo',
        'docestudiante',
        'acudiente',
        'parentesco',
        'numerodias',
        'fecha',
        'motivo',
        'tiporeg',
        'tipocit',
        'correctivo',
        'docente',
        'compromiso',
        'correctivo',
        'versionestudiante',
        'versiondocente',
        'versionfamilia',
        'observaciones',
        'estado'
    ];
}
