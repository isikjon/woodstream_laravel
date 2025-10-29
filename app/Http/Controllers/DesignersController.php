<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesignersController extends Controller
{
    public function index()
    {
        return view('designers.index');
    }
}
