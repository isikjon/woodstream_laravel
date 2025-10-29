<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class PriceRangeService
{
    protected $ranges = [
        ['min' => 0, 'max' => 50000, 'label' => 'До 50 000 ₽'],
        ['min' => 50000, 'max' => 100000, 'label' => '50 000 - 100 000 ₽'],
        ['min' => 100000, 'max' => 200000, 'label' => '100 000 - 200 000 ₽'],
        ['min' => 200000, 'max' => 500000, 'label' => '200 000 - 500 000 ₽'],
        ['min' => 500000, 'max' => null, 'label' => 'От 500 000 ₽'],
    ];

    public function getRanges()
    {
        return collect($this->ranges)->map(function ($range, $index) {
            return [
                'key' => $index,
                'min' => $range['min'],
                'max' => $range['max'],
                'label' => $range['label'],
                'count' => $this->getCountForRange($range['min'], $range['max'])
            ];
        })->filter(function ($range) {
            return $range['count'] > 0;
        });
    }

    protected function getCountForRange($min, $max)
    {
        return Cache::remember("price_range_{$min}_{$max}", 3600, function () use ($min, $max) {
            $query = DB::connection('production')
                ->table('products')
                ->where(function ($q) use ($min, $max) {
                    $q->where(function ($subQ) use ($min, $max) {
                        $subQ->where('price', '>=', $min);
                        if ($max !== null) {
                            $subQ->where('price', '<=', $max);
                        }
                    })->orWhere(function ($subQ) use ($min, $max) {
                        $subQ->where('special', '>', 0)
                            ->where('special', '>=', $min);
                        if ($max !== null) {
                            $subQ->where('special', '<=', $max);
                        }
                    });
                });

            return $query->count();
        });
    }

    public function applyFilter($query, array $selectedRanges)
    {
        if (empty($selectedRanges)) {
            return $query;
        }

        $query->where(function ($q) use ($selectedRanges) {
            foreach ($selectedRanges as $rangeKey) {
                if (!isset($this->ranges[$rangeKey])) {
                    continue;
                }

                $range = $this->ranges[$rangeKey];
                $min = $range['min'];
                $max = $range['max'];

                $q->orWhere(function ($subQuery) use ($min, $max) {
                    $subQuery->where(function ($priceQuery) use ($min, $max) {
                        $priceQuery->where('price', '>=', $min);
                        if ($max !== null) {
                            $priceQuery->where('price', '<=', $max);
                        }
                    })->orWhere(function ($specialQuery) use ($min, $max) {
                        $specialQuery->where('special', '>', 0)
                            ->where('special', '>=', $min);
                        if ($max !== null) {
                            $specialQuery->where('special', '<=', $max);
                        }
                    });
                });
            }
        });

        return $query;
    }
}

