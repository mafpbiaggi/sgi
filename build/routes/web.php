<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
    Route::resource('visitors', VisitorController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});

require __DIR__ . '/settings.php';
require __DIR__ . '/iam/permissions.php';
require __DIR__ . '/iam/roles.php';
require __DIR__ . '/iam/users.php';

