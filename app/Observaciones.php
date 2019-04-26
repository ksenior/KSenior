<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observaciones extends Model
{
    protected $table = 'obsestudiante';

    public $fillable = [
    	'ano',
        'numerodoc',
        'periodo',
        'codobservacion'
    ];
}
