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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Sister
    Route::post('sisters/media', 'SisterApiController@storeMedia')->name('sisters.storeMedia');
    Route::apiResource('sisters', 'SisterApiController');

    // Klien
    Route::post('kliens/media', 'KlienApiController@storeMedia')->name('kliens.storeMedia');
    Route::apiResource('kliens', 'KlienApiController');

    // Contract
    Route::apiResource('contracts', 'ContractApiController');
});