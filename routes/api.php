<?php

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
Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');
Route::get('films', 'FilmController@index');
Route::get('to/films', function () {
    return redirect('/api/films');
});
Route::get('genres', 'FilmController@fetchGenres');
Route::get('films/{slug}', 'FilmController@show');
Route::post('films', 'FilmController@store');
Route::get('logout', 'ApiController@logout');
Route::group(['middleware' => ['jwt.auth', 'jwt.refreshToken']], function () {
    Route::post('comment', 'CommentController@store');
});
