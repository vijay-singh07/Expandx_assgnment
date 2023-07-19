<?php

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

use App\Http\Controllers\StudentController;

Route::get('/', [StudentController::class, 'showUploadForm'])->name('csv.upload.form');
Route::post('/upload', [StudentController::class, 'uploadCSV'])->name('csv.upload');
Route::get('/students', [StudentController::class, 'index'])->name('students.index');


