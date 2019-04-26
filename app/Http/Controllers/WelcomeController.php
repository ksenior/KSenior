<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WelcomeController extends Controller
{
    public function index(){
        if (!Auth::check()){
            return view('welcome');
        } else {
            //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|'.Auth::user()->name.'|Inicio|Ingreso a Sistema de Información de Recaudos SIT');
            return view('home');
        }
    }
}
