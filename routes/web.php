<?php

use App\Http\Controllers\TaskController;
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

Route::prefix('tasks')->group(function () {
    Route::get('index', [TaskController::class, 'index'])->name("tasks-index");
    Route::put('updateTitle', [TaskController::class, 'updateTitle'])->name("tasks-update-title");
    Route::get('edit/{task}', [TaskController::class, 'edit'])->name("tasks-edit");
    Route::post('store', [TaskController::class, 'store'])->name("tasks-store");
    Route::get('create', [TaskController::class, 'create'])->name("tasks-create");
    Route::get('show/{task}', [TaskController::class, 'show']);
});
