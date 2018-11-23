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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('form_categories', 'FormCategoryController')->middleware('auth');
Route::resource('forms', 'FormController')->middleware('auth');
Route::resource('questions', 'QuestionController')->middleware('auth');
Route::resource('answers', 'AnswerController')->middleware('auth');
Route::resource('quiz', 'QuizController')->middleware('auth');
Route::resource('informacion', 'InformacionController')->middleware('auth');
