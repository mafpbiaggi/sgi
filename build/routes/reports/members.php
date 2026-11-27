<?php

use App\Http\Controllers\Reports\MemberReportController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->prefix('reports/')->group(function () {
    Route::get('/members', [MemberReportController::class, 'index'])->name('members_report.index');
    Route::post('/members/pdf', [MemberReportController::class, 'generate'])->name('members_report.generate');
});
