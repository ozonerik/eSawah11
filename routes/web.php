<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Backend\Profile;
use App\Livewire\Backend\Dashboard;
use App\Livewire\Backend\Giss;
use App\Livewire\Backend\Sawahs;
use App\Livewire\Backend\Result;
use App\Livewire\Backend\Appconfigs;
use App\Livewire\Backend\Infos;
use App\Livewire\Backend\Users;
use App\Livewire\Frontend\Home;
use App\Livewire\Test;

/* Route::get('/', function () {
    return view('welcome');
});
 */
/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::get('/', Home::class);
Route::get('/test', Test::class);
Route::get('/home', Home::class)->name('home');

Route::group(['middleware' => ['auth','verified']], function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/search', Result::class)->name('result');
    Route::get('/sawahs', Sawahs::class)->name('sawahs');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/pawongans', Profile::class)->name('pawongans');
    Route::get('/lanjas', Profile::class)->name('lanjas');
    Route::get('/bayarlanjas', Profile::class)->name('bayarlanjas');
    Route::group(['middleware' => ['role:pro']], function () {
        Route::get('/giss', Giss::class)->name('giss');
    });
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/referensi', Appconfigs::class)->name('referensi');
        Route::get('/users', Users::class)->name('users');
        Route::get('/infos', Infos::class)->name('infos');
        Route::get('/giss', Giss::class)->name('giss');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
/*     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); */
});

require __DIR__.'/auth.php';
