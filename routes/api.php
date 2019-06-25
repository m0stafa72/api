<?php

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});


Route::apiResource('/Auth','API\AuthController');

Route::post('/getUsers/{key}' , 'API\Get_usersController@search');
Route::post('/getUser/{id}' , 'API\Get_usersController@getUser');

Route::apiResource('/chats','API\ChatController');
// Route::post('/getChats' , 'API\ChatController@getChats');

Route::post('/getStartMessages','API\ChatController@getStartMessages');
Route::post('/getMessages','API\ChatController@getMessages');

Route::post('/Auth/avatar/{key}','API\AuthController@updateAvatar');
