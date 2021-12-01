<?php

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
    return view('auth.login');
});


Route::group(['middleware' => 'auth'], function () {
        Route::get('/home',function(){ return view('home'); })->name('dashboard');
        Route::get('forwarder', [App\Http\Controllers\dataController::class, 'forwarder'])->name('forwarder');
        Route::get('successfull', [App\Http\Controllers\dataController::class, 'successfull'])->name('successfull');
        Route::get('profile', [App\Http\Controllers\userController::class, 'profile'])->name('profile');
        Route::post('profile/Update', [App\Http\Controllers\userController::class, 'update'])->name('profile.update');
        Route::get('daterange', [App\Http\Controllers\dataController::class, 'datefilter'])->name('daterange');
        Route::get('daterange2', [App\Http\Controllers\dataController::class, 'datefilter2'])->name('daterange2');
        Route::get('export', [App\Http\Controllers\dataController::class, 'index']);
        Route::post('update',[App\Http\Controllers\dataController::class, 'successUpdate'])->name('updateId');


});




require __DIR__.'/auth.php';
