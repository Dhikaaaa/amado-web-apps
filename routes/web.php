<?php

use App\Http\Controllers\Api\Notification\NotificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\UserController;
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

/**
 * TODO : Nanti route disesuaikan dengan Laravel 8
 */
Route::middleware('auth')->group(function () {
	Route::get('/', [HomeController::class, 'index'])->name('home');
	Route::view('/setting', 'setting')->name('setting')->middleware('can:isAdmin');

	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

	Route::post('/user/datatables', [UserController::class, 'datatables'])->name('user.datatables')->middleware('can:isAdmin');

	Route::prefix('rack')->name('rack.')->group(function () {
		Route::view('/', 'rack')->name('index');
		Route::post('/search', [RackController::class, 'search'])->name('search');
	});

	Route::prefix('book')->name('book.')->group(function () {
		Route::post('/datatables', [BookController::class, 'datatables'])->name('datatables');
		Route::post('/search', [BookController::class, 'search'])->name('search');
	});

	Route::prefix('member')->name('member.')->group(function () {
		Route::post('/datatables', [MemberController::class, 'datatables'])->name('datatables');
		Route::post('/search', [MemberController::class, 'search'])->name('search');
	});

	Route::prefix('loan')->name('loan.')->group(function () {
		Route::post('/datatables', [LoanController::class, 'datatables'])->name('datatables');
		Route::view('/return', 'loan.return')->name('return');
		Route::view('/extend', 'loan.extend')->name('extend');
	});

	Route::resource('book', BookController::class);
	Route::resource('member', MemberController::class, ['except' => ['show']]);
	Route::resource('user', UserController::class, ['except' => ['show']])->middleware('can:isAdmin');
	Route::resource('loan', LoanController::class, ['except' => ['show', 'edit', 'update']]);
});

Route::middleware('guest')->group(function () {
	Route::view('/login', 'auth.login')->name('login');
});


/**
 * * Route Notification
 */
Route::get('/send-notification', [NotificationController::class, 'sendNotification']);
