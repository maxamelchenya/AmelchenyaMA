<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SortController;
use App\Http\Controllers\AddController;
use App\Http\Controllers\AjaxController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// за маршрут / ответственный index controller метод index
Route::get('/', [IndexController::class, 'index']);
// за маршрут /services ответственный index controller метод services
Route::get('/services', [IndexController::class, 'services']);
// за маршрут /contacts ответственный index controller метод contacts (далее по аналогии)
Route::get('/contacts', [IndexController::class, 'contacts']);
Route::get('/blog', [BlogController::class, 'list']);
Route::get('/blog/{slug}', [BlogController::class, 'item']);


Route::get('/catalog', [IndexController::class, 'category']);
Route::get ('/catalog/category/{categoryId}', [IndexController::class, 'choosenCategory']);
Route::get ('/catalog/country/{countryId}', [IndexController::class, 'choosenCountry']);
Route::get ('/catalog/price/{price}', [IndexController::class, 'choosenPrice']);

Route::get('/search', [SearchController::class, 'search']);
Route::get('/sort', [SortController::class, 'sort']);

Route::get('/add', [AddController::class, 'show']);
Route::post('/adding', [AddController::class, 'store']);

Route::post('/ajaxAdd', [AjaxController::class, 'addBet']);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();
// за маршрут home ответственный home controoler метод index
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('is_admin');

Route::get('/clear-route', function() {
    Artisan::call('route:clear');
    return "route is cleared";
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/clear-optimize', function() {
    Artisan::call('optimize');
    return "optimize is cleared";
});

Route::get('/db-seed', function() {
    Artisan::call('db:seed');
    return "optimize is cleared";
});
