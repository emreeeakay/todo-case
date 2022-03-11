<?php

use App\Http\Controllers\TodoListController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/todolist', [TodoListController::class, 'index'])->middleware(['urlControl']);
Route::get('/todolist/getData/{id}', [TodoListController::class, 'getData']);
Route::post('/todolist/save', [TodoListController::class, 'save']);
Route::post('/todolist/update', [TodoListController::class, 'update']); // must be Put or Patch
Route::post('/todolist/delete', [TodoListController::class, 'delete']); // must be Delete
