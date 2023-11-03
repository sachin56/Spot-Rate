<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AERequestController;
use App\Http\Controllers\AdminLoginController;

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

//Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login',[AdminLoginController::class,'index'])->name('admin.index');
    Route::post('/login/owner',[AdminLoginController::class,'checklogin'])->name('admin.login');
    Route::get('/dashboard',[AdminLoginController::class,'dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::post('/logout',[AdminLoginController::class,'adminlogout'])->name('admin.logout')->middleware('admin');

    Route::get('/ae-requestform',[AERequestController::class,'index'])->name('AE')->middleware('admin');

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/ae-requestform',[AERequestController::class,'index'])->name('AE');
});

require __DIR__.'/auth.php';
