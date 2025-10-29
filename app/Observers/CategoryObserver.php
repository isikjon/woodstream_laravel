<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    public function created(Category $category): void
    {
        cache()->forget('header_categories');
    }

    public function updated(Category $category): void
    {
        cache()->forget('header_categories');
    }

    public function deleted(Category $category): void
    {
        cache()->forget('header_categories');
    }

    public function restored(Category $category): void
    {
        cache()->forget('header_categories');
    }

    public function forceDeleted(Category $category): void
    {
        cache()->forget('header_categories');
    }
}
