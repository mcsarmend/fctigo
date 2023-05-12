<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class labelledController extends Controller
{
    public function jucavibursa()
    {
        return view('etiquetado.jucavi.bursa');
    }
    public function jucavipromecap()
    {
        return view('etiquetado.jucavi.promecap');
    }
    public function jucaviblao()
    {
        return view('etiquetado.jucavi.blao');
    }
    public function mambubursa()
    {
        return view('etiquetado.mambu.bursa');
    }
    public function mambupromecap()
    {
        return view('etiquetado.mambu.promecap');
    }
    public function mambublao()
    {
        return view('etiquetado.mambu.blao');
    }
    public function mambumintos()
    {
        return view('etiquetado.mambu.mintos');
    }
}
