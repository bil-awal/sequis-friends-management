<?php

use App\Http\Controllers\v1\V1FriendshipController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request)
{
    return $request->user();
});

Route::group(['prefix' => 'v1', 'as' => 'ApiV1'], function ()
{
    Route::group(['prefix' => 'friendship', 'as' => 'Friendship'], function ()
    {
        Route::post('/', [V1FriendshipController::class, 'friend'])->name('');

        Route::group(['prefix' => 'request', 'as' => 'Request'], function ()
        {
            Route::post('/', [V1FriendshipController::class, 'request'])->name('');
            Route::post('list', [V1FriendshipController::class, 'requestList'])->name('List');
            Route::post('block', [V1FriendshipController::class, 'requestBlock'])->name('Block');
        });

        Route::post('accept', [V1FriendshipController::class, 'accept'])->name('Accept');
        Route::post('reject', [V1FriendshipController::class, 'reject'])->name('Reject');
        Route::post('pending', [V1FriendshipController::class, 'pending'])->name('Pending');

    });
});
