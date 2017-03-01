<?php
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

Route::group(['middleware' => 'auth:api'], function () {

    //Checklists
    Route::get('/get/checklists', 'ChecklistController@index');
    Route::post('/create/checklist', 'ChecklistController@create');
    Route::put('/edit/checklist', 'ChecklistController@edit');
    Route::delete('/delete/checklist/{id}', 'ChecklistController@delete');


    //Items
    Route::get('/get/items/{id}', 'ItemsController@index');
    Route::post('/create/item', 'ItemsController@create');
    Route::delete('/delete/item/{id}', 'ItemsController@delete');

});
