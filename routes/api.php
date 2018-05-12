<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
/**
    removed the session middleware (not needed in rest-api)
    with only ajax request we can use
    put => place in the DB
    patch => update the DB
    delete => remove from the DB
*/

// Route::post('/account', [
//     'uses' => 'AccountController@postAccount'
// ]);

// Route::get('/account', [
//     'uses' => 'AccountController@getAccount'
// ]);

// Route::put('/account/{id}', [
//     'uses' => 'AccountController@setAccount'
// ]);

// Route::delete('/account/{id}', [
//     'uses' => 'AccountController@removeAccount'
// ]);

Route::post('/user', [
    'uses' => 'UserController@signup'
]);