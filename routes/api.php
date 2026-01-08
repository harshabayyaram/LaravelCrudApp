<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;

Route::apiResource('items', ItemsController::class);
