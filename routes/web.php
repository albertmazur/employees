<?php

use App\Http\Controllers\EmployeeController;
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

Route::get("/", [EmployeeController::class, "getList"])
    ->name("list");

Route::get("/{emp_no}", [EmployeeController::class, "getSingleEmployee"])
    ->where('emp_no', '[0-9]+')
    ->name("single");

Route::post("/download", [EmployeeController::class, "postDownload"])
    ->name("download");