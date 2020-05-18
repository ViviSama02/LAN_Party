<?php

use App\Http\Controllers\RegistrationController;
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


Route::resource('lan', 'LanController');

Route::post('tournament/{tournament}/start', 'TournamentController@start')->name('tournament.start');
Route::post('lan/{lan}/tournament/{tournament}/register', 'TournamentController@register')->name('lan.tournament.register');
Route::post('lan/{lan}/tournament/{tournament}/unregister', 'TournamentController@unregister')->name('lan.tournament.unregister');
Route::resource('lan.tournament', 'TournamentController');

Route::get('team/{team}/edit', 'TeamController@edit')->name('team.edit');
Route::post('team/{team}/update', 'TeamController@update')->name('team.update');
Route::post('team/{team}/join', 'TeamController@join')->name('team.join'); // Bouton pour demander à rejoindre une équipe
Route::post('team/{team}/quit', 'TeamController@quit')->name('team.quit'); // Bouton pour quitter son équipe ou annuler une demande de rejoindre une équipe.
                                                                                             // Se désinscrit aussi si l'utilisateur est le dernier membre de son équipe
Route::post('team/{team}/accept/{user}', 'TeamController@accept')->name('team.accept'); // Bouton pour accepter une demande pour rejoindre une équipe
Route::post('team/{team}/refuse/{user}', 'TeamController@refuse')->name('team.refuse'); // Bouton pour refuser une demande pour rejoindre une équipe

Route::get('/test', function() {

    $certificate = storage_path('app' . DIRECTORY_SEPARATOR . 'cacert.pem');
    $client = new \GuzzleHttp\Client([
        'verify' => $certificate,
        'headers' => [
            'user-key' => '56145fb31a7b6b024f813b2505ab975f'
        ]
    ]);

    $res = $client->request('POST', 'https://api-v3.igdb.com/games', [
        'body' => 'fields name,id; sort popularity desc; where name ~ *"Starcraft"*;'
    ]);

    $json = json_decode($res->getBody());

    foreach($json as $game) {

        echo $game->name;

        $res = $client->request('POST', 'https://api-v3.igdb.com/covers', [
            'body' => "fields image_id; where game = " . $game->id . ";"
        ]);
        $images = json_decode($res->getBody());
        foreach($images as $image) {

            echo "<img src='https://images.igdb.com/igdb/image/upload/t_1080p_2x/{$image->image_id}.jpg'>";
        }
    }
});

RegistrationController::routes();