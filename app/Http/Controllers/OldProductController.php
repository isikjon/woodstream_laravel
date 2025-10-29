<?php

namespace App\Http\Controllers;

use App\Models\OldProduct;
use App\Models\OldCategory;
use Illuminate\Http\Request;

class OldProductController extends Controller
{
    public function index(Request $request)
    {
        $query = OldProduct::with(['categories', 'city', 'country', 'status']);

        if ($request->has('category') && $request->category) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('id', $request->category);
            });
        }

        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('model', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('price_from') && $request->price_from) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->has('price_to') && $request->price_to) {
            $query->where('price', '<=', $request->price_to);
        }

        $products = $query->paginate(12);
        $categories = OldCategory::whereNull('parent_id')->with('children')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = OldProduct::with(['categories', 'city', 'country', 'status'])->findOrFail($id);
        $relatedProducts = OldProduct::whereHas('categories', function($q) use ($product) {
            $q->whereIn('id', $product->categories->pluck('id'));
        })->where('id', '!=', $product->id)->limit(4)->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
