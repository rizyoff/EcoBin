<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\View\View;

class reedemController extends Controller
{
    //
    public function index(){
        return view('reedem.reedem');
    }
}
