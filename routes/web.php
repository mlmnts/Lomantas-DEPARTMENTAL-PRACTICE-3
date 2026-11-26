<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('books.index'));

// 'auth' = must be logged in, 'admin' = must be an administrator
Route::middleware(['auth', 'admin'])->group(function () {
    // index, create, store, show, edit, update, destroy
    Route::resource('books', BookController::class);

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/pdf', [ReportController::class, 'pdf'])->name('reports.pdf');
    Route::get('/reports/excel', [ReportController::class, 'excel'])->name('reports.excel');
});

require __DIR__.'/auth.php';