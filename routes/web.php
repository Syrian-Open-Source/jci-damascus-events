<?php

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\EventController;
use App\Http\Controllers\Site\TableController;
use App\Http\Controllers\Site\MenuController;
use App\Http\Controllers\Site\LangController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::post('/events', [LangController::class, '__invoke'])->name('change_lang');

Route::group(['middleware' => ['auth', 'verified', 'approved']], function () {
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::get('/events/{event}/tables', [TableController::class, 'show'])->name('tables.show');
    Route::get('/events/{event}/menus', [MenuController::class, 'show'])->name('menu.show');
    Route::post('/menu/{menu}/save-items', [MenuController::class, 'save'])->name('menus.save_user_items');
    Route::post('/table/{foodTable}/register', [TableController::class, 'registerInTable'])->name('table.register_in_table');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
