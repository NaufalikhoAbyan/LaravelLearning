<?php

use App\Http\Controllers\RealtorListingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserAccoutController;

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

Route::get('/', function(){
    return redirect('/listing');
});
Route::get('/hello', [IndexController::class, 'show']);

Route::resource('/listing', ListingController::class)->only(['index', 'show']);

Route::get('/login', [AuthController::class, 'create'])->name('login.create');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::delete('/logout', [AuthController::class, 'destroy'])->name('login.destroy');

Route::get('/register', [UserAccoutController::class, 'create'])->name('register.create');
Route::post('/register', [UserAccoutController::class, 'store'])->name('register.store');

Route::prefix('realtor')->name('realtor.')->middleware('auth')->group(function(){
    Route::put('/listing/{listing}/restore', [RealtorListingController::class, 'restore'])->name('listing.restore')->withTrashed();
    Route::resource('/listing', RealtorListingController::class)->except(['show']);
});
