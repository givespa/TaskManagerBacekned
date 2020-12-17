<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ExcelController;

//========================== API TASK MANAGER =====================
Route::group(['prefix' => 'task'], static function () {

    Route::get('/', [TaskController::class, 'index'])->name('task.index');  // index reister
    Route::get('/{id}', [TaskController::class, 'index'])->name('task.get');  // get task
    Route::post('/', [TaskController::class, 'create'])->name('task.create'); // create register
    Route::put('/{id}', [TaskController::class, 'update'])->name('task.update'); // update register
    Route::delete('/{id}', [TaskController::class, 'destroy'])->name('task.delete'); // delete register
});

//========================== API FILE =====================
Route::group(['prefix' => 'file'], static function () {

    Route::get('/', [ExcelController::class, 'data'])->name('file.data');  // 
    Route::post('/', [ExcelController::class, 'import'])->name('import.file'); // 
});

