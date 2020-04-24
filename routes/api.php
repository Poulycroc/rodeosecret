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
    $router->patch('settings/profile', ['uses' => 'Settings\ProfileController@update']);
    $router->patch('settings/password', ['uses' => 'Settings\PasswordController@update']);

    $router->get('categories', 'CategoryController@index');
    $router->post('categories', 'CategoryController@create');
    $router->get('categories/{id}', 'CategoryController@show');
    $router->put('categories/{id}', 'CategoryController@update');
    $router->delete('categories/{id}', 'CategoryController@destroy');
    
    $router->get('competitions', 'CompetitionController@index');
    $router->post('competitions', 'CompetitionController@create');
    $router->get('competitions/{id}', 'CompetitionController@show');
    $router->put('competitions/{id}', 'CompetitionController@update');
    $router->delete('competitions/{id}', 'CompetitionController@destroy');
});

$router->group([], function () use ($router) {
    $router->post('register', ['uses' => 'Auth\RegisterController@store']);
    $router->post('login', ['uses' => 'Auth\LoginController@login']);
});

$router->group(['prefix' => 'password'], function () use ($router) {
    $router->post('email', ['uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    $router->post('reset', ['uses' => 'Auth\ResetPasswordController@reset']);
});
