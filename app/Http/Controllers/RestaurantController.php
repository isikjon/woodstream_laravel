<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;

class RestaurantController extends Controller
{
    public function index()
    {
        $portfolio = Portfolio::active()->ordered()->get();
        
        return view('restaurant.index', compact('portfolio'));
    }
}
