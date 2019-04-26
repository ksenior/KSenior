<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $table = 'disciplina';

    public $fillable = [
    	'ano',
        'numerodoc',
        'periodo',
        'codobservacion'
    ];
}
