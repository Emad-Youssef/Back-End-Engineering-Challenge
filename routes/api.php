<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [App\Http\Controllers\Api\AuthController::class ,'login']);
Route::post('/register', [App\Http\Controllers\Api\AuthController::class ,'register']);


Route::group(['prefix' => 'talks'], function() {
    // POST add a talk
    Route::post('/', [App\Http\Controllers\Api\TalksController::class ,'new_talk']);
    // to add an attendee to a talk
    Route::post('/{talk_id}/attendees', [App\Http\Controllers\Api\TalksController::class ,'add_attendee_talk']);
    // DELETE
    Route::post('/{talk_id}/attendees/{attendee_id}', [App\Http\Controllers\Api\TalksController::class ,'remove_attendee_talk']);
    // GET to see all talks
    Route::get('/', [App\Http\Controllers\Api\TalksController::class ,'talks']);
    // to see list of attendees at that talk
    Route::get('/{talk_id}/attendees', [App\Http\Controllers\Api\TalksController::class ,'talk_attendees']);
});

Route::group(['prefix' => 'attendees'], function() {
    // POST to add an attendee
    Route::post('/', [App\Http\Controllers\Api\AttendeesController::class ,'new_attendee']);
    // GET to see all attendees
    Route::get('/', [App\Http\Controllers\Api\AttendeesController::class ,'attendees']);
});

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', 'AuthController@logout');
    Route::get('/user', 'AuthController@user');
});
