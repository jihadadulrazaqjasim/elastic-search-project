<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::post('/saveDocuments', [HomeController::class, 'saveDocuments']);

Route::get('/search',[HomeController::class,'search']);
Route::get('/searchProcess/{searchedText}',[HomeController::class,'searchProcess']);
Route::get('/getIndices', [HomeController::class,'getIndices']);

Route::post('/deleteIndex', [HomeController::class,'deleteIndex']);