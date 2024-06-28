<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\WindNoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

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

Route::middleware(['web'])->group(function () {
    // 認証不要ルート
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    // 認証必要ルート
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
});



// 認証必要ルート
Route::middleware([EnsureFrontendRequestsAreStateful::class, 'auth:sanctum'])->group(function () {

    Route::get('check-auth', function (Request $request) {
        return response()->json(['authenticated' => true], 200);
    });
});
// 他の認証が必要なルート
Route::get('/windNote', [WindNoteController::class, 'index'])->name('windNote.index');
Route::post('/windNote', [WindNoteController::class, 'store'])->name('windNote.store');
Route::get('/windNote/{windNote}', [WindNoteController::class, 'show'])->name('windNote.show');
Route::put('/windNote/{windNote}', [WindNoteController::class, 'update'])->name('windNote.update');
Route::delete('/windNote/{windNote}', [WindNoteController::class, 'destroy'])->name('windNote.destroy');

Route::get('/question', [QuestionController::class, 'index'])->name('question.index');
Route::post('/question', [QuestionController::class, 'store'])->name('question.store');
Route::get('/question/{question}', [QuestionController::class, 'show'])->name('question.show');
Route::put('/question/{question}', [QuestionController::class, 'update'])->name('question.update');
Route::delete('/question/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');

Route::post('/answer', [AnswerController::class, 'store'])->name('answer.store');

Route::get('/calendar', [CalendarEventController::class, 'index'])->name('calendarEvent.index');
Route::post('/calendar', [CalendarEventController::class, 'store'])->name('calendarEvent.store');
