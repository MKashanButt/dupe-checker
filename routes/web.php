<?php

use App\Http\Controllers\FindDupeMedicare;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddCSVData;

Route::get('/', function () {
    return view('index');
});

Route::get('/check-medicare-id', [FindDupeMedicare::class, 'find']);


Route::view('/admin', 'admin.index');
Route::view('/admin/form', 'admin.form');
Route::post('/upload-csv', [AddCSVData::class, 'uploadCSV'])->name('upload-csv');
