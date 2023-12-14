<?php

use App\Models\Post;
use App\Models\ShopItem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/store', function () {
    Cache::put('shop-items', ShopItem::all());
    return 'added items to cache';
});

Route::get('/retrieve', function () {
    $cachedItems = Cache::get('shop-items');
    return ['retrieved items from cache', $cachedItems];
});

Route::get('/remove', function () {
    Cache::forget('shop-items');
    return ['removed items from cache'];
});

Route::get('/check', function () {
    if (Cache::has('shop-items')) {
        return ['items retrieved from cached', Cache::get('shop-items')];
    } else {
        return ['items queried from database', ShopItem::all()];
    }
});

Route::get('create-item', function () {
    return ShopItem::factory()->create();
});

Route::get('remember', function () {
    return Cache::remember('shop-items', 30, function () {
        return ShopItem::all();
    });
});

Route::get('posts', function () {
    return Post::with('tags')->get();
});

Route::get('search-posts', function () {
    return Post::search('mag')->get();
});

Route::get('dispatch-job', function () {
    \App\Jobs\SendEmails::dispatch()->onConnection('redis');
});
