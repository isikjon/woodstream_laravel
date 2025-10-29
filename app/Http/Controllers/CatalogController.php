<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OldProduct;
use App\Models\OldCategory;
use App\Models\OldCity;
use App\Models\OldCountry;
use App\Models\OldStyle;

class CatalogController extends Controller
{
    public function index(Request $request, $categorySlug = null)
    {
        try {
            $category = null;
            $query = OldProduct::with(['categories', 'city', 'country', 'status', 'styles']);

            if ($categorySlug) {
                $category = OldCategory::where('slug', $categorySlug)->first();
                
                if ($category) {
                    $query->whereHas('categories', function ($q) use ($category) {
                        $q->where('categories.id', $category->id);
                    });
                }
            }

            if ($request->has('search') && $request->search) {
                $query->where(function($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%')
                      ->orWhere('model', 'like', '%' . $request->search . '%');
                });
            }

            if ($request->has('status') && is_array($request->status)) {
                $statusMap = [
                    'available' => 7,
                    'sold' => 5,
                    'coming_soon' => 10,
                    'custom_order' => 8,
                    'reserved' => 9,
                    'restoration' => 11,
                ];
                
                $statusIds = array_map(function($status) use ($statusMap) {
                    return $statusMap[$status] ?? null;
                }, $request->status);
                
                $statusIds = array_filter($statusIds);
                
                if (!empty($statusIds)) {
                    $query->whereIn('availability', $statusIds);
                }
            }

            if ($request->has('city') && is_array($request->city)) {
                $cityIds = OldCity::whereIn('name', $request->city)->pluck('id');
                if ($cityIds->isNotEmpty()) {
                    $query->whereIn('city_id', $cityIds);
                }
            }

            if ($request->has('categories') && is_array($request->categories)) {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->whereIn('categories.id', $request->categories);
                });
            }

            if ($request->has('style') && is_array($request->style)) {
                $query->whereHas('styles', function ($q) use ($request) {
                    $q->whereIn('styles.name', $request->style);
                });
            }


            if ($request->has('country') && is_array($request->country)) {
                $countryIds = OldCountry::whereIn('name', $request->country)->pluck('id');
                if ($countryIds->isNotEmpty()) {
                    $query->whereIn('id_country', $countryIds);
                }
            }

            if ($request->has('price_from') && $request->price_from) {
                $query->where('price', '>=', $request->price_from);
            }

            if ($request->has('price_to') && $request->price_to) {
                $query->where('price', '<=', $request->price_to);
            }

            $products = $query
            ->orderByRaw('CASE 
                WHEN availability IN (7, 8) THEN 1
                WHEN availability = 5 THEN 3
                ELSE 2
            END')
            ->orderBy('priority', 'desc')
            ->paginate(24)
            ->appends($request->except('page'));

        $categories = OldCategory::whereNull('parent_id')
            ->where('name', 'Винтажная мебель')
            ->with('children')
            ->get();

            $cities = OldCity::whereNotIn('name', ['Санкт-Петербург'])
            ->orderBy('name')
            ->pluck('name')
            ->filter();
            $styles = OldStyle::orderBy('name')->pluck('name')->filter();
            $countries = OldCountry::orderBy('name')->pluck('name')->filter();

            return view('catalog.index', compact(
                'products',
                'category',
                'categories',
                'cities',
                'styles',
                'countries'
            ));
        } catch (\Exception $e) {
            \Log::error('CatalogController: Ошибка подключения к продакшн БД: ' . $e->getMessage());
            abort(500, 'Ошибка подключения к базе данных');
        }
    }
}
