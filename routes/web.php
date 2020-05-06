<?php

use App\Http\Controllers\LANController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('accueil');
});*/

/*Route::get('/liste', function () {
    return view('lans/liste_lan');
});

Route::get('/inscription', function () {
    return view('utilisateur/inscription');
});*/


// Accueil
Route::redirect(RouteServiceProvider::HOME, '/');
Route::get('/', 'HomeController@index');
Route::get('/dashboard', 'HomeController@dashboard');

// Routes pour l'authentification
Auth::routes();

Route::post('lan/{lan}/register', 'LANController@register')->name('lan.register');
Route::post('lan/{lan}/unregister', 'LANController@unregister')->name('lan.unregister');
Route::resource('lan', 'LANController');