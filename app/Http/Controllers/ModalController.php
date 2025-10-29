<?php

namespace App\Http\Controllers;

use App\Models\Modal;

class ModalController extends Controller
{
    public function index()
    {
        $modals = Modal::active()->orderBy('order')->get();
        
        return view('modals.index', compact('modals'));
    }
}

