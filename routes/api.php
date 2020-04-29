<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['middleware' => 'laravel.jwt'], function () use ($router) {
    $router->get('user', function () {
        return auth()->user();
    });
    $router->post('logout', ['uses' => 'Auth\LoginController@logout']);

    $router->group([
        'prefix' => 'settings'
    ], function ($router) {
        $router->patch('/profile', ['uses' => 'Settings\ProfileController@update']);
        $router->patch('/password', ['uses' => 'Settings\PasswordController@update']);
    });
    
    $router->group([
        'prefix' => 'categories'
    ], function ($router) {
        $router->get('/', 'CategoryController@index');
        $router->post('/', 'CategoryController@create');
        $router->get('/{id}', 'CategoryController@show');
        $router->put('/{id}', 'CategoryController@update');
        $router->delete('/{id}', 'CategoryController@destroy');
    });
    
    $router->group([
        'prefix' => 'competitions'
    ], function ($router) {
        $router->get('/', 'CompetitionController@index');
        $router->get('/landing', 'CompetitionController@landing');
        $router->post('/', 'CompetitionController@create');
        $router->get('/{id}', 'CompetitionController@show');
        $router->put('/{id}', 'CompetitionController@update');
        $router->delete('/{id}', 'CompetitionController@destroy');
    });

    $router->group([
        'prefix' => 'participants'
    ], function ($router) {
        $router->get('/', 'ParticipantController@index');
        $router->get('/signed/{competitionId}', 'ParticipantController@signed');
        $router->get('/winners/{competitionId}', 'ParticipantController@winners');
        $router->post('/', 'ParticipantController@create');
        $router->get('/{id}', 'ParticipantController@show');
        $router->put('/{id}', 'ParticipantController@update');
        $router->delete('/{id}', 'ParticipantController@destroy');
    });

    $router->group([
        'prefix' => 'winners'
    ], function ($router) {
        $router->get('/', 'WinnerController@index');
        $router->get('generate/{competitionID}', 'WinnerController@generateWinner');
        $router->post('/save', 'WinnerController@create');
        $router->put('/', 'WinnerController@update');
        $router->delete('/', 'WinnerController@destroy');
    });
});

$router->group([], function () use ($router) {
    $router->post('register', ['uses' => 'Auth\RegisterController@store']);
    $router->post('login', ['uses' => 'Auth\LoginController@login']);
});

$router->group(['prefix' => 'password'], function () use ($router) {
    $router->post('email', ['uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    $router->post('reset', ['uses' => 'Auth\ResetPasswordController@reset']);
});
