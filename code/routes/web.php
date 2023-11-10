<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UUserController;
use App\Http\Controllers\URolesController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AERequestController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\PricingRateController;
use App\Http\Controllers\AERequestTableController;

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

    Route::get('/ae-requestform',[AERequestController::class,'index'])->name('AEAdmin')->middleware('admin');
    Route::get('/ae-requestform/create',[AERequestController::class,'create'])->middleware('admin');
    Route::post('/ae-requestform/store',[AERequestController::class,'store'])->middleware('admin');
    Route::get('/ae-requestform/{id}',[AERequestController::class,'show'])->middleware('admin');
    Route::put('/ae-requestform/{id}',[AERequestController::class,'update'])->middleware('admin');
    Route::put('/ae-requestform/status/{id}',[AERequestController::class,'ae_change_status']);

    Route::get('/requesttable',[AERequestTableController::class,'index'])->name('AETable')->middleware('admin');

    Route::get('/pricing-form',[PricingRateController::class,'index'])->name('pricing')->middleware('admin');
    Route::get('/pricing-form/create',[PricingRateController::class,'create'])->middleware('admin');
    Route::post('/pricing-form',[PricingRateController::class,'store'])->middleware('admin');

    Route::get('/billing-form',[BillingController::class,'index'])->name('billing')->middleware('admin');
    Route::get('/billing-form/create',[BillingController::class,'create'])->middleware('admin');


    Route::get('/role',[URolesController::class,'index'])->name('role')->middleware('admin');
    Route::post('/role', [URolesController::class,'store']);
    Route::get('/role/create', [URolesController::class,'create']);
    Route::get('/role/{id}', [URolesController::class,'show']);
    Route::put('/role/{id}', [URolesController::class,'update']);
    Route::delete('/role/{id}', [URolesController::class,'destroy']);

    //user_managment->user
    Route::get('/user', [UUserController::class,'index'])->name('user')->middleware('admin');
    Route::post('/user', [UUserController::class,'store']);
    Route::get('/user/create', [UUserController::class,'create']);
    Route::get('/user/{id}', [UUserController::class,'show']);
    Route::put('/user/{id}', [UUserController::class,'update']);
    Route::delete('/user/{id}', [UUserController::class,'destroy']);
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

    Route::get('/ae-requestform',[AERequestController::class,'index'])->name('request_rate');
    Route::get('/ae-requestform/create',[AERequestController::class,'create']);
    Route::post('/ae-requestform/store',[AERequestController::class,'store']);
    Route::get('/ae-requestform/{id}',[AERequestController::class,'show']);
    Route::put('/ae-requestform/{id}',[AERequestController::class,'update']);
    Route::put('/ae-requestform/status/{id}',[AERequestController::class,'ae_change_status']);

    Route::get('/requesttable',[AERequestTableController::class,'index']);

    Route::get('/pricing-form',[PricingRateController::class,'index']);
    Route::get('/pricing-form/create',[PricingRateController::class,'create']);
    Route::post('/pricing-form',[PricingRateController::class,'store']);

    Route::get('/billing-form',[BillingController::class,'index']);
    Route::get('/billing-form/create',[BillingController::class,'create']);

    Route::get('/role',[URolesController::class,'index']);
    Route::post('/role', [URolesController::class,'store']);
    Route::get('/role/create', [URolesController::class,'create']);
    Route::get('/role/{id}', [URolesController::class,'show']);
    Route::put('/role/{id}', [URolesController::class,'update']);
    Route::delete('/role/{id}', [URolesController::class,'destroy']);

    //user_managment->user
    Route::get('/user', [UUserController::class,'index']);
    Route::post('/user', [UUserController::class,'store']);
    Route::get('/user/create', [UUserController::class,'create']);
    Route::get('/user/{id}', [UUserController::class,'show']);
    Route::put('/user/{id}', [UUserController::class,'update']);
    Route::delete('/user/{id}', [UUserController::class,'destroy']);
});

require __DIR__.'/auth.php';
