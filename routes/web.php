<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoppingListController;


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

// 買い物リスト
Route::get('/', [AuthController::class, 'index'])->name('front.index');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/shopping_list/list', [ShoppingListController::class, 'list']);

Route::get('/register', [UserController::class, 'index']);