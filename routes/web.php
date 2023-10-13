<?php

use App\Http\Controllers\ListingController;
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

// All Listings
Route::get('/',[ListingController::class,'index']);

// Show Create Form
Route::get('/create',[ListingController::class,'create']);

// Store Listing Data
Route::post('/store',[ListingController::class,'store'])->name('list.store');

// Show Edit Form
Route::get('/{listing}/edit', [ListingController::class, 'edit']);

// Update Listing
Route::put('/{listing}', [ListingController::class, 'update']);

// Delete Listing
Route::delete('/{listing}', [ListingController::class, 'destroy']);