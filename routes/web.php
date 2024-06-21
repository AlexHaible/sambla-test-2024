<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

// web.php
Route::view('/', 'employee.form');
Route::post('/submit', [EmployeeController::class, 'store']);
