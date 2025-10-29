<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AntiqueController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DesignersController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\OnlineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\OldProductController;
use App\Http\Controllers\OldBlogController;
use App\Http\Controllers\SearchController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search/autocomplete', [SearchController::class, 'autocomplete'])->name('search.autocomplete');
Route::get('/search', [SearchController::class, 'results'])->name('search');

Route::prefix('old')->group(function () {
    Route::get('/products', [OldProductController::class, 'index'])->name('old.products');
    Route::get('/products/{id}', [OldProductController::class, 'show'])->name('old.product.show');
    Route::get('/blog', [OldBlogController::class, 'index'])->name('old.blog');
    Route::get('/blog/{id}', [OldBlogController::class, 'show'])->name('old.blog.show');
});
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/antique', [AntiqueController::class, 'index'])->name('antique');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/catalog/{categorySlug}', [CatalogController::class, 'index'])->name('catalog.category');
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');
Route::get('/delivery', [DeliveryController::class, 'index'])->name('delivery');
Route::get('/designers', [DesignersController::class, 'index'])->name('designers');
Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant');
Route::get('/online', [OnlineController::class, 'index'])->name('online');
Route::get('/order', [OrderController::class, 'index'])->name('order');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/repair', [RepairController::class, 'index'])->name('repair');
Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews');
Route::post('/reviews', [ReviewsController::class, 'store'])->name('reviews.store');
