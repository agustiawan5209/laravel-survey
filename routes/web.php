<?php

use App\Http\Controllers\CetakLaporanController;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelawanController;
use App\Http\Controllers\DataSurveyController;

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
    return redirect()->route('login');
});

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/simpanData', [RelawanController::class, 'store'])->middleware(['auth', 'verified'])->name('Relawan.store');

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'Survey', 'as' => 'Survey.'], function () {
        Route::controller(SurveyController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('Buat', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('detail/{id}', 'show')->name('show');
            Route::get('Detail/Survey/{id}', 'detail')->name('detail');
            Route::delete('delete/{id}', 'destroy')->name('delete');
            Route::get('Edit/{id}', 'edit')->name('edit');
            Route::put('Update/{id}', 'update')->name('update');
            Route::get('/Success', 'success')->name('success');
        });
    });
    Route::group(['prefix' => 'DataSurvey', 'as' => 'DataSurvey.'], function () {
        Route::controller(DataSurveyController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('Buat', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('detail/{id}', 'show')->name('show');
            Route::delete('delete/{id}', 'destroy')->name('delete');
            Route::get('Edit/{id}', 'edit')->name('edit');
            Route::put('Update/{id}', 'update')->name('update');
            Route::get('DataRelawan/{username}', 'ShowDataRelawan')->name('ShowDataRelawan');
            Route::get('/Success', 'success')->name('success');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/Cetak', [CetakLaporanController::class, 'Index'])->name('Cetak.Index');
    Route::get('/cetakDataSurvey', [CetakLaporanController::class, 'cetakDataSurvey'])->name('Cetak.DataSurvey');
    Route::get('/cetakDataSurveyPDF', [CetakLaporanController::class, 'cetakDataSurveyPDF'])->name('Cetak.DataSurveyPDF');
});

require __DIR__ . '/auth.php';
