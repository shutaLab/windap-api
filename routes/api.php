<?php

use App\Http\Controllers\WindNoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/windNote', [WindNoteController::class, 'index'])->name('windNote.index');
Route::post('/windNote', [WindNoteController::class, 'store'])->name('windNote.store');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
