<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class reportController extends Controller
{
    public function recuperacioncartera()
    {
        return view('reportes.reporterecuperacioncartera');
    }
    public function sesioncartera()
    {
        return view('reportes.reportesesioncartera');
    }
    public function fondeadores()
    {
        return view('reportes.fondeadores.fondeadores');
    }
}
