<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AntiqueController extends Controller
{
    public function index()
    {
        return view('antique.index');
    }
}
