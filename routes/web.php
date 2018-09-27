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




// Route::get('/Login', function () {
//     return "Your login page";
// });


Route::get('/posts/index', 'PostController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function(){
Route::resource('companies', 'CompaniesController');
Route::post('projects/adduser', 'ProjectsController@adduser')->name('projects.adduser');
Route::get('projects/create/{company_id?}', 'ProjectsController@create');
Route::resource('projects', 'ProjectsController');
Route::resource('roles', 'RolesController');
Route::resource('tasks', 'TasksController');
Route::resource('users', 'UserController'); 
Route::resource('comments', 'CommentsController'); 
});