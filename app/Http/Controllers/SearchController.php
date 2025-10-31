<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OldProduct;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function autocomplete(Request $request)
    {
        try {
            $query = $request->get('q', '');
            
            if (mb_strlen($query) < 2) {
                return response()->json([]);
            }

            $cacheKey = 'search_' . md5($query);
            
            $products = Cache::remember($cacheKey, 600, function() use ($query) {
                $productsQuery = OldProduct::where('availability', '!=', 5)
                    ->where('availability', '!=', 9)
                    ->where(function($q) use ($query) {
                        $q->where('name', 'LIKE', "%{$query}%")
                          ->orWhere('model', 'LIKE', "%{$query}%");
                    })
                    ->orderByRaw("CASE 
                        WHEN name LIKE ? THEN 1
                        WHEN model LIKE ? THEN 2
                        ELSE 3
                    END", ["{$query}%", "{$query}%"])
                    ->orderBy('priority', 'desc')
                    ->limit(8)
                    ->get(['id', 'name', 'model', 'price', 'special', 'availability', 'avatar']);
                
                if ($productsQuery->isEmpty()) {
                    $productsQuery = OldProduct::where('availability', '!=', 9)
                        ->where(function($q) use ($query) {
                            $q->where('name', 'LIKE', "%{$query}%")
                              ->orWhere('model', 'LIKE', "%{$query}%");
                        })
                        ->orderByRaw("CASE 
                            WHEN name LIKE ? THEN 1
                            WHEN model LIKE ? THEN 2
                            ELSE 3
                        END", ["{$query}%", "{$query}%"])
                        ->orderBy('priority', 'desc')
                        ->limit(8)
                        ->get(['id', 'name', 'model', 'price', 'special', 'availability', 'avatar']);
                }
                
                return $productsQuery;
            });
            
            $results = $products->map(function($product) {
                $price = $product->special > 0 ? $product->special : $product->price;
                $statusText = $this->getStatusText($product->availability);
                
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'code' => $product->model ?: '',
                    'price' => number_format($price, 0, ',', ' ') . ' ₽',
                    'status' => $statusText,
                    'url' => route('product.show', $product->id),
                    'image' => $product->main_image ?? null,
                ];
            });
            
            return response()->json($results);
        } catch (\Exception $e) {
            \Log::error('SearchController: Ошибка автокомплита: ' . $e->getMessage());
            \Log::error('SearchController: Stack trace: ' . $e->getTraceAsString());
            return response()->json(['error' => 'Ошибка поиска'], 500);
        }
    }

    protected function getStatusText($availability)
    {
        return match($availability) {
            5 => 'Продан',
            7 => 'В наличии',
            8 => 'Под заказ',
            9 => 'Забронировано',
            10 => 'Скоро в продаже',
            11 => 'Под реставрацию',
            default => 'В наличии',
        };
    }
    
    public function results(Request $request)
    {
        $query = $request->get('q', '');
        
        if (mb_strlen($query) < 2) {
            return redirect()->route('catalog');
        }
        
        $products = OldProduct::where('availability', '!=', 5)
            ->where('availability', '!=', 9)
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('model', 'LIKE', "%{$query}%")
                  ->orWhere('sku', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->orderBy('priority', 'desc')
            ->orderBy('order', 'desc')
            ->paginate(24);
        
        return view('catalog.index', [
            'products' => $products,
            'searchQuery' => $query,
        ]);
    }
}
