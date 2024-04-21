<?php

use App\Http\Controllers\Admin\CustomCourseIntakeController;
use App\Http\Controllers\HomeController;
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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('courses-intake', [CustomCourseIntakeController::class,'index'])->name('admin.course-intake');
    Route::post('courses-intake', [CustomCourseIntakeController::class,'store'])->name('admin.course-intake.store');
    Route::get('courses-intake/{id}', [CustomCourseIntakeController::class,'edit'])->name('admin.course-intake.edit');
    Route::post('course-intake', [CustomCourseIntakeController::class,'update'])->name('admin.course-intake.update');
    Route::delete('course-intake-delete/', [CustomCourseIntakeController::class,'delete'])->name('admin.course-intake.delete');
});

Route::get('/', [HomeController::class,'index'])->name('home');
