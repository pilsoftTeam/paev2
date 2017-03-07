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
    Route::put('/edit/item', 'ItemsController@edit');
    Route::delete('/delete/item/{id}', 'ItemsController@delete');


    //Evaluaciones
    Route::get('/get/evaluaciones/{id}', 'EvaluacionesController@getEvaluaciones');
    Route::post('/create/evaluacion', 'EvaluacionesController@create');
    Route::put('/edit/evaluacion', 'EvaluacionesController@editEvaluacion');
    Route::delete('/delete/evaluacion/{id}', 'EvaluacionesController@deleteEvaluacion');

    //Evaluaciones Creator
    Route::get('/get/evaluacion/info/{id}', 'EvaluacionesController@getInfo');
    Route::get('/get/opciones/cumplimiento', 'EvaluacionesController@getOpcionesCumplimiento');

    Route::post('/save/cumplimiento', 'EvaluacionesController@saveCumplimiento');
    Route::put('/set/opcion', 'EvaluacionesController@setCumplimientoEvaluacion');
    Route::put('/update/evaluacion', 'EvaluacionesController@editEvaluacionFromEditor');
    Route::delete('/delete/cumplimiento/{id}', 'EvaluacionesController@deleteCumplimiento');


    //Agrupaciones
    Route::post('/create/agrupacion', 'AgrupacionesController@create');
    Route::put('/edit/agrupacion', 'AgrupacionesController@edit');
    Route::delete('/delete/agrupacion/{id}', 'AgrupacionesController@delete');


    //Supervisor
    Route::get('/get/supervision/revisores', 'SupervisorController@getRevisores');
    Route::get('/get/supervision/proveedores', 'SupervisorController@getProveedores');

});
