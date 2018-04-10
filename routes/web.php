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

$router->get('/', function () use ($router) {
    return "You are in a right place ";
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('user',  ['uses' => 'UserController@index']);
    $router->get('user/{id}',  ['uses' => 'UserController@show']);
    $router->get('user/{id}/friends',  ['uses' => 'UserController@showFriends']);
    $router->get('user/{id}/ranking',  ['uses' => 'UserController@getRankingPosition']);
    $router->post('user/{id}/edit',  ['uses' => 'UserController@edit']);
    $router->post('user/find',  ['uses' => 'UserController@find']);
    $router->post('user/login',  ['uses' => 'UserController@check']);
    $router->post('user/register',  ['uses' => 'UserController@create']);

    $router->get('quiz', ['uses' => 'QuizController@index']);
    $router->get('quiz/{id}',  ['uses' => 'QuizController@show']);
    $router->get('quiz/{id}/questions',  ['uses' => 'QuizController@showQuestions']);
    $router->post('quiz/{id}/edit',  ['uses' => 'QuizController@edit']);

    $router->get('featuredQuiz', ['uses' => 'FeaturedQuizController@index']);
    $router->get('featuredQuiz/{id}',  ['uses' => 'FeaturedQuizController@show']);

    $router->get('blacklist/{id}', ['uses' => 'BlacklistController@show']);
    $router->post('blacklist',  ['uses' => 'BlacklistController@create']);
});
