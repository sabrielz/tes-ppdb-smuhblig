<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UniformController;
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
// Route::get('/dashboard/questions', fn () => view('dashboard.index'));
// Route::get('/dashboard/room', fn () => view('dashboard.index'));
Route::get('/tes', function() {
// 	// dd(\App\Models\Question::with('jurusan')->get());
//     dd(\App\Models\Config::getConfig('metadata', []));
		// dd(\App\Models\Question::whereRelation('jurusan', 'nama', 'Teknik Komputer dan Jaringan')->get());
		dd(\App\Models\PPDB\Identitas::whereHas('jenis_kelamin')->with('jenis_kelamin')->limit(5)->get());

});

Route::get('/', fn () => redirect( route('login.index') ))->name('index');

Route::controller(LoginController::class)->middleware('guest')->group(function () {
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login', 'login')->name('login.post');
});

Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('/dashboard')->middleware('auth')->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard.index');
    });

    Route::controller(StudentController::class)->group(function () {
        Route::get('/student', 'index')->name('dashboard.student.index');
        Route::get('/student/{student:id}', 'select')->name('dashboard.student.select');
    });

    Route::controller(RoomController::class)->middleware(['test'])->group(function () {
        Route::get('/loby', 'index')->name('dashboard.loby.index');
    });

    Route::controller(UniformController::class)->group(function () {
        Route::get('/uniform', 'index')->name('dashboard.uniform.index');
        Route::get('/uniform/edit', 'edit')->name('dashboard.uniform.edit');
        Route::post('/uniform/{uniform}', 'update')->name('dashboard.uniform.update');
    });

    Route::controller(TestController::class)->middleware(['test'])->group(function () {
        Route::get('/test', 'index')->middleware(['student'])->name('dashboard.test.index');
        Route::post('/test', 'store')->name('dashboard.test.store');
    });

    Route::controller(QuestionController::class)->group(function () {
        Route::get('/question', 'index')->middleware(['test'])->name('dashboard.question.index');
        Route::get('/question/create', 'create')->name('dashboard.question.create');
		Route::post('/question/create', 'store')->name('dashboard.question.store');
        Route::get('/question/{question}/edit', 'edit')->name('dashboard.question.edit');
        Route::post('/question/{question}', 'update')->name('dashboard.question.update');
        Route::get('/question/{question}/delete', 'delete')->name('dashboard.question.delete');
    });

    Route::controller(StatisticController::class)->middleware(['test'])->group(function () {
        Route::get('/statistic', 'index')->name('dashboard.statistic.index');
        Route::get('/statistic/detail', 'detail')->name('dashboard.statistic.detail');
        Route::get('/statistic/edit', 'edit')->name('dashboard.statistic.edit');
        Route::post('/statistic/edit', 'update')->name('dashboard.statistic.update');
    });
});
