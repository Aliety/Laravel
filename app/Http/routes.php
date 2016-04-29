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
Route::get('/test', function () {
    return view('thesis.edit');
});

Route::get('/home', 'HomeController@index');
Route::get('/news', 'HomeController@news');
Route::get('/home/topic/{id}', 'HomeController@topic');
Route::post('/ajax', 'MessageController@ajax');

Route::group(['middleware' => 'web'], function () {
    Route::get('message/sent', 'MessageController@sent');
    Route::delete('message/linkDelete/{id}', 'MessageController@linkDelete');
    Route::resource('message', 'MessageController');

});
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
    Route::get('/upload/report', 'Admin\UploadController@showReport');
    Route::post('/upload/file', 'Admin\UploadController@uploadFile');
    Route::post('/upload/report', 'Admin\UploadController@uploadReport');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/admin/login', 'Admin\AuthController@getLogin');
    Route::post('/admin/login', 'Admin\AuthController@postLogin');
    Route::get('/admin/logout', 'Admin\AuthController@logout');

    Route::get('/admin/password/email', 'Admin\PasswordController@getEmail');
    Route::post('/admin/password/email', 'Admin\PasswordController@postEmail');
    Route::get('/admin/password/reset/{token}', 'Admin\PasswordController@getReset');
    Route::post('/admin/password/reset', 'Admin\PasswordController@postReset');

    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/enter', 'AdminController@enter');
    Route::get('/admin/user', 'AdminController@userIndex');
    Route::get('/admin/topic', 'AdminController@topicIndex');
    Route::get('/admin/topic/{id}', 'AdminController@topicShow');
    Route::post('/admin/topic/{id}', 'AdminController@topicCheck');
    Route::delete('/admin/topic/user', 'AdminController@selectDelete');
    Route::delete('/admin/topic/{id}', 'AdminController@topicDelete');
    Route::get('/admin/teacher', 'AdminController@teacherIndex');
    Route::post('/admin/user/create', 'AdminController@userAdd');
    Route::post('/admin/teacher/create', 'AdminController@teacherAdd');
    Route::delete('/admin/user/{id}', 'AdminController@userDelete');
    Route::delete('/admin/teacher/{id}', 'AdminController@teacherDelete');
    Route::get('admin/user/{id}', 'AdminController@user');
    Route::get('admin/teacher/{id}', 'AdminController@teacher');
    Route::get('admin/upload', 'Admin\UploadController@index');
    Route::resource('/admin/news', 'NewsController');
    Route::resource('/admin/notice', 'NoticeController');
    Route::delete('admin/upload/file', 'Admin\UploadController@deleteFile');
    Route::post('admin/upload/folder', 'Admin\UploadController@createFolder');
    Route::delete('admin/upload/folder', 'Admin\UploadController@deleteFolder');

    Route::get('admin/defense/show', 'AdminController@showDefense');
    Route::get('admin/defense/check', 'AdminController@defenseCheck');
    Route::get('admin/defense/check/create', 'AdminController@createCheck');
    Route::post('admin/defense/check/{id}', 'AdminController@storeCheck');
    Route::get('admin/defense/group', 'AdminController@defenseGroup');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/teacher/login', 'Teacher\AuthController@getLogin');
    Route::post('/teacher/login', 'Teacher\AuthController@postLogin');
    Route::get('/teacher/logout', 'Teacher\AuthController@logout');
    Route::get('/teacher/password/new', 'Teacher\PasswordController@showForm');
    Route::post('/teacher/password/new', 'Teacher\PasswordController@newReset');

    Route::get('/teacher/password/email', 'Teacher\PasswordController@getEmail');
    Route::post('/teacher/password/email', 'Teacher\PasswordController@postEmail');
    Route::get('/teacher/password/reset/{token}', 'Teacher\PasswordController@getReset');
    Route::post('/teacher/password/reset', 'Teacher\PasswordController@postReset');

    Route::get('/teacher/enter', 'TeacherController@enter');
    Route::get('/teacher/home', 'TeacherController@information');
    Route::get('/teacher/check', 'TeacherController@showCheck');
    Route::post('/teacher/check/{id}', 'TeacherController@storeCheck');
    Route::resource('teacher', 'TeacherController', ['except' => ['show']]);
    Route::get('topic/state/{id}', 'Topic\TopicController@state');
    Route::get('topic/active/{topic_id}/{user_id}', 'Topic\TopicController@active');
    Route::resource('topic', 'Topic\TopicController');
    Route::get('/teacher/thesis', 'Admin\UploadController@showThesis');
    Route::get('/teacher/report', 'Admin\UploadController@showTeacherReport');
    Route::post('/file/download', 'Admin\UploadController@downloadFile');
    Route::get('/thesis/check', 'ThesisController@edit');
    Route::post('/thesis/check/{id}', 'ThesisController@update');
    Route::post('/report/check/{id}', 'ThesisController@updateReport');
    Route::get('/teacher/topic/score', 'Topic\TopicController@showScore');
    Route::post('/teacher/topic/score', 'Topic\TopicController@confirmScore');
    Route::resource('task', 'TaskController');
    Route::get('teacher/user/{id}', 'TeacherController@user');

    Route::get('teacher/defense/index', 'TeacherController@indexDefense');
    Route::post('teacher/defense/check/{id}', 'TeacherController@checkDefense');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('login', 'Auth\AuthController@showLoginForm');
    Route::post('login', 'Auth\AuthController@login');
    Route::get('logout', 'Auth\AuthController@logout');
    Route::get('password/new', 'Auth\PasswordController@showResetForm');
    Route::post('password/new', 'Auth\PasswordController@newReset');

    Route::get('password/email', 'Auth\PasswordController@getEmail');
    Route::post('password/email', 'Auth\PasswordController@postEmail');
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');

    Route::get('user/enter', 'UserController@enter');
    Route::get('user/home', 'UserController@information');
    Route::get('user/teacher/{id}', 'UserController@teacher');
    Route::resource('/user', 'UserController');
    Route::get('user/topic/select', 'Topic\TopicSelectController@index');
    Route::post('user/topic/confirm', 'Topic\TopicSelectController@confirm');
    Route::get('user/topic/show', 'Topic\TopicSelectController@show');
    Route::get('user/task/show', 'TaskController@showTask');
    Route::get('/user/check/show', 'UserController@showCheck');
    Route::delete('user/topic/delete', 'Topic\TopicSelectController@delete');
    Route::post('user/topic/bread', 'Topic\TopicSelectController@bread');
});
