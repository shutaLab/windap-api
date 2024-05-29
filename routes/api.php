<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\QuestionController;
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
// ウィンドノート
Route::get('/windNote', [WindNoteController::class, 'index'])->name('windNote.index');
Route::post('/windNote', [WindNoteController::class, 'store'])->name('windNote.store');
Route::get('/windNote/{windNote}', [WindNoteController::class, 'show'])->name('windNote.show');
Route::put('/windNote/{windNote}', [WindNoteController::class, 'update'])->name('windNote.update');
Route::delete('/windNote/{windNote}', [WindNoteController::class, 'destroy'])->name('windNote.destroy');
// 質問
Route::get('/question', [QuestionController::class, 'index'])->name('question.index');
Route::post('/question', [QuestionController::class, 'store'])->name('question.store');
Route::get('question/{question}', [QuestionController::class, 'show'])->name('question.show');
Route::put('/question/{question}', [QuestionController::class, 'update'])->name('question.update');
Route::delete('/question/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');

// 回答
Route::post('/answer', [AnswerController::class, 'store'])->name('answer.store');

// カレンダー
Route::get('/calendar', [CalendarEventController::class, 'index'])->name('calendarEvent.index');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
