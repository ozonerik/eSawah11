<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Backend\Profile;
use App\Livewire\Frontend\Home;

/* Route::get('/', function () {
    return view('welcome');
});
 */
/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::get('/', Home::class);
Route::get('/home', Home::class)->name('home');

Route::group(['middleware' => ['auth','verified']], function () {
    Route::get('/dashboard', Profile::class)->name('dashboard');
    Route::get('/result', Profile::class)->name('result');
    Route::get('/sawahs', Profile::class)->name('sawahs');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/pawongans', Profile::class)->name('pawongans');
    Route::get('/lanjas', Profile::class)->name('lanjas');
    Route::get('/bayarlanjas', Profile::class)->name('bayarlanjas');
    Route::group(['middleware' => ['role:pro']], function () {
        Route::get('/giss', Profile::class)->name('giss');
    });
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/referensi', Profile::class)->name('referensi');
        Route::get('/users', Profile::class)->name('users');
        Route::get('/infos', Profile::class)->name('infos');
        Route::get('/giss', Profile::class)->name('giss');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
/*     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); */
});

require __DIR__.'/auth.php';
