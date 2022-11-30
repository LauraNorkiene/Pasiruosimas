<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('administrator')->group(function () {
    Route::resources([
        'city'=> CityController::class,
        'hotel'=> HotelController::class
    ]);
});


Route::get('city/{id}/hotels',[HotelController::class, 'cityHotels'])->name('cityHotels');
Route::get('/image/{name}',[HotelController::class, 'display']) ->name('images');
Route::post('posts/search',[HotelController::class, 'findPost'])->name('find.post');
Route::put('rate/{id}', [HotelController::class, 'rateHotels'])->name('ivertinti');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
