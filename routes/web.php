<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', fn () => view('pages.index'));
// Route::get('/dashboard', fn () => view('dashboard.index'));
Route::get('/dashboard/questions', fn () => view('dashboard.index'));
Route::get('/dashboard/room', fn () => view('dashboard.index'));
Route::get('/tes', function() {
	dd(\App\Models\Question::filter(['jurusan' => 2])->with('jurusan')->get());
	// dd(\App\Models\Question::with('jurusan')->get('id'));
	// dd(\App\Models\Config::getConfig('metadata', []));
});

Route::prefix('/dashboard')->middleware('guest')->group(function () {

    Route::controller(\App\Http\Controllers\DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard.index');
    });

});
