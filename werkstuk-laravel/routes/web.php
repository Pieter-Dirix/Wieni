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
//alle routes op de index
Route::get('/', [
    'uses' => 'TrainingController@getIndex',
    'as' => 'home'
]);


Route::get('index.php', [
    'uses' => 'TrainingController@getIndex',
    'as' => 'home'
]);

Route::get('/voorijbetrainingen', [
    'uses'=> 'TrainingController@getOudeTrainingen',
    'as' => 'voorbijetrainingen'
]);



Route::get('/about', [
    'uses' => 'StartController@getAbout',
    'as' => 'about'
]);

Route::get('/training/{id}', [
    'uses' => 'TrainingController@getTraining',
    'as' => 'training'
]);


Auth::routes();

Route::get('/login', [
    'uses' => 'StartController@getLogin',
    'as' => 'login'
]);


Route::get('/home', [
    'uses' => 'HomeController@index',
    'as' => 'start'
]);
//alle admin routes
Route::group(['prefix' => 'admin'], function() {
    Route::get('', [
        'uses' => 'AdminController@getIndex',
        'as' => 'admin.index'
    ]);
    Route::get('create', [
        'uses' => 'AdminController@getCreate',
        'as' => 'admin.create'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'AdminController@getEdit',
        'as' => 'admin.edit'
    ]);

    Route::get('delete/{id}', [
        'uses' => 'AdminController@getDelete',
        'as' => 'admin.delete'
    ]);

});
//routes om een training aan te maken en aan te passen
Route::post('/trainingcreate', [
    'uses' => 'TrainingController@postCreateTraining',
    'as' => 'trainingcreate'
]);

Route::post('/trainingedit', [
    'uses' => 'TrainingController@postEditTraining',
    'as' => 'trainingedit'
]);

//Groepen en trainers routes
Route::group(['prefix' => 'groepenentrainers'], function() {
    Route::get('/main', [
        'uses' => 'ListController@getLists',
        'as' => 'lists.groepenentrainers'
    ]);

    Route::get('/groep/{id}', [
        'uses' => 'ListController@getGroep',
        'as' => 'groep'
    ]);

    Route::get('/trainer/{id}', [
        'uses' => 'ListController@getTrainer',
        'as' => 'trainer'
    ]);
});