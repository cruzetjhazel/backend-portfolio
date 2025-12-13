<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;

Route::get('/', [ProjectController::class, 'index'])->name('projects.index');

Route::resource('projects', ProjectController::class);
