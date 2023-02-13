<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'getLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login');
Route::get('/logout', [AuthController::class, 'getLogout']);

Route::post('/arsip', [ArsipController::class, 'postAddArsip'])->middleware('auth');
Route::post('/arsipexcel', [ArsipController::class, 'postAddArsipExcel'])->middleware('auth');
Route::put('/arsip/{id}', [ArsipController::class, 'putArsip'])->middleware('auth');
Route::delete('/arsip/{id}', [ArsipController::class, 'deleteArsip'])->middleware('auth');

Route::get('/api/autocomplete', [ApiController::class, 'autocomplete']);
Route::get('/api/addarsip', [ApiController::class, 'getAddArsip'])->middleware('auth');
Route::get('/api/getarsip/{id}', [ApiController::class, 'getArsip'])->middleware('auth');
Route::get('/api/addarsipexcel', [ApiController::class, 'getAddArsipExcel'])->middleware('auth');

Route::get('/download/templateexcel', [DownloadController::class, 'templateExcel']);
