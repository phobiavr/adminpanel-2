<?php

use Illuminate\Support\Facades\Route;
use Nova\Custom\Http\Controllers\InlineTextFieldController;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::post('/inline-text-update/{resource}', [InlineTextFieldController::class, 'update']);
