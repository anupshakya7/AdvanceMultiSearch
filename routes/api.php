<?php

use App\Http\Controllers\API\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Search View API 
Route::prefix('search')->group(function(){
    Route::get('/university',[SearchController::class,'university'])->name('dropdown.university');
    Route::get('/course',[SearchController::class,'course'])->name('dropdown.course');
    Route::get('/intake',[SearchController::class,'intake'])->name('dropdown.intake');
});
//Search View API 