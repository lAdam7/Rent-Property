<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ApplylandlordController;
use App\Http\Controllers\LandlordController;
use App\Http\Controllers\AdminLandlordController;
use App\Http\Controllers\PropertyController;

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

Auth::routes([
    'verify' => true
]);

Route::get('/', [PropertyController::class, 'index']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [LoginController::class, 'create'])->middleware('guest');
Route::post('login', [LoginController::class, 'store'])->middleware('guest');

Route::post('logout', [LogoutController::class, 'destroy'])->middleware('auth');

Route::get('verify/{token}', [RegisterController::class, 'update'])->name('verify'); 

Route::middleware('can:verified')->group(function() {
    Route::get('apply', [ApplylandlordController::class, 'create']);
    Route::post('apply', [ApplylandlordController::class, 'store']);

    Route::get('apply/success', function() {
        return view('apply-landlord.success');
    });
});

Route::middleware('can:landlord')->group(function() {
    Route::get('dashboard/properties', [LandlordController::class, 'index']);
    Route::get('dashboard/add', [LandlordController::class, 'create']);
    Route::post('dashboard/add', [LandlordController::class, 'store']);
});

Route::middleware('can:admin')->group(function() {
    Route::get('admin', function() {
        return view('admin.home');
    });

    Route::get('/admin/applications/landlords', [ApplyLandlordController::class, 'index'])->name('applications/landlords');
    Route::post('admin/applications/landlords/{application}', [ApplyLandlordController::class, 'update']);
    Route::delete('admin/applications/landlords/{application}', [ApplyLandlordController::class, 'destroy']);

    Route::get('/admin/applications/properties', [AdminLandlordController::class, 'index'])->name('applications/properties');
    Route::patch('/admin/applications/properties/{property}', [AdminLandlordController::class, 'update']);
    Route::delete('/admin/applications/properties/{property}', [AdminLandlordController::class, 'destroy']);
});