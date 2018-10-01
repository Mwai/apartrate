<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return redirect('films');
//});
//Route::get('to/films', function () {
//    return redirect('films');
//});
Route::get('/{vue_capture?}', function () {
    return view('layout');
})->where('vue_capture', '^(?!storage).*$');
//Route::get('films/{slug}', 'FilmController@showPage');
//Route::post('login', 'AuthController@login');
//Route::post('register', 'AuthController@login');
//Route::post('logout', 'AuthController@login');
//Route::post('comment', 'FilmController@addComment');
