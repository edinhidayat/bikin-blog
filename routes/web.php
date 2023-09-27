<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Cviebrock\EloquentSluggable\Services\SlugService;

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

// HALAMAN UTAMA
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/a/{id}',[HomeController::class,'tampil']);

// MIDDLEWARE GUEST
Route::get('/login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'login']);
Route::get('/logout',[LoginController::class,'logout']);

// MIDDLEWARE AUTH
Route::get('check_slug', function () {
    $slug = SlugService::createSlug(App\Models\Post::class, 'slug', request('judul'));
    return response()->json(['slug' => $slug]);
});
Route::resource('/dashboard', DashboardController::class)->middleware('auth');
