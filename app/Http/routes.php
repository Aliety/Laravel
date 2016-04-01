<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('ajax', 'Topic\TopicSelectController@ajax');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('/topic/select', 'Topic\TopicSelectController@index');
    Route::get('/topic/confirm', 'Topic\TopicSelectController@confirm');
    Route::get('user/topic/show', 'Topic\TopicSelectController@show');
    Route::get('/upload/file', 'Admin\UploadController@showFile');
    Route::post('/upload/file', 'Admin\UploadController@uploadFile');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/admin/login', 'Admin\AuthController@getLogin');
    Route::post('/admin/login', 'Admin\AuthController@postLogin');
    Route::get('/admin/register', 'Admin\AuthController@getRegister');
    Route::post('/admin/register', 'Admin\AuthController@postRegister');
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/enter', 'AdminController@enter');
    Route::get('admin/upload', 'Admin\UploadController@index');
    Route::resource('new', 'NewController');
    Route::delete('admin/upload/file', 'Admin\UploadController@deleteFile');
    Route::post('admin/upload/folder', 'Admin\UploadController@createFolder');
    Route::delete('admin/upload/folder', 'Admin\UploadController@deleteFolder');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/teacher/login', 'Teacher\AuthController@getLogin');
    Route::post('/teacher/login', 'Teacher\AuthController@postLogin');
    Route::get('/teacher/logout', 'Teacher\AuthController@logout');
    Route::get('/teacher/register', 'Teacher\AuthController@getRegister');
    Route::post('/teacher/register', 'Teacher\AuthController@postRegister');
    Route::get('/teacher/enter', 'TeacherController@enter');
    Route::resource('teacher', 'TeacherController', ['except' => ['show']]);
    Route::get('topic/state/{id}', 'Topic\TopicController@state');
    Route::get('topic/active/{topic_id}/{user_id}', 'Topic\TopicController@active');
    Route::resource('topic', 'Topic\TopicController');
    Route::get('/teacher/thesis', 'Admin\UploadController@showThesis');
    Route::post('/file/download', 'Admin\UploadController@downloadFile');
    Route::get('/thesis/check', 'ThesisController@edit');
    Route::post('/thesis/check/{id}', 'ThesisController@update');
    Route::get('/teacher/topic/score', 'Topic\TopicController@showScore');
    Route::post('/teacher/topic/score', 'Topic\TopicController@confirmScore');
    Route::resource('task', 'TaskController');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('user/enter', 'UserController@enter');
    Route::resource('/user', 'UserController');
    Route::get('user/topic/select', 'Topic\TopicSelectController@index');
    Route::post('user/topic/confirm', 'Topic\TopicSelectController@confirm');
    Route::get('user/topic/show', 'Topic\TopicSelectController@show');
    Route::get('user/task/show', 'TaskController@showTask');
    Route::delete('user/topic/delete', 'Topic\TopicSelectController@delete');

});
