<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PassportAuthController;
use App\Http\Middleware\EnsureApiTokenIsValid;
use App\Http\Controllers\API\SearchController;

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

Route::post('oauth/token', [PassportAuthController::class, 'oauth_token']);

Route::middleware([EnsureApiTokenIsValid::class])->group(function () {
Route::get('search/suggestions', [SearchController::class, 'suggestions']);
Route::get('search/keywords', [SearchController::class, 'keywords']);
});




