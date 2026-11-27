<?php

use App\Http\Controllers\Iam\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('roles', RoleController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});
