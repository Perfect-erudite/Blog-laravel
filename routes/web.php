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


// Route::get('/posts/index', 'PostController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::middleware(['moderator', 'auth'])->group(function(){

    Route::get('companies', 'CompaniesController@index'); //To get all companies from the company's controller index
    Route::get('projects', 'ProjectsController@index'); //To get all projects from the project's controller index     
    Route::get('tasks', 'TasksController@index'); //To get all tasks from the task's controller index  
    
    

    Route::middleware(['admin'])->group(function(){
        Route::get('users', 'UsersController@index'); //To get all users from the user's controller index
        Route::delete('users/{id}', 'UsersController@destroy');
        Route::resource('roles', 'RolesController');
        
    });

});  



Route::middleware(['auth'])->group(function(){
    Route::resource('companies', 'CompaniesController');
    Route::post('projects/adduser', 'ProjectsController@adduser')->name('projects.adduser');
    Route::post('tasks/adduser', 'TasksController@adduser')->name('tasks.adduser');
    Route::get('projects/create/{company_id?}', 'ProjectsController@create');
    Route::resource('projects', 'ProjectsController');
    Route::resource('tasks', 'TasksController');
    Route::resource('comments', 'CommentsController'); 
    Route::resource('users', 'UsersController');
    
});



