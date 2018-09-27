<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //if(!Schema::hasTable('users')){
        Schema::create('tasks', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');     //The name of the task
            $table->integer('project_id')->unsigned(); //To track the project of the task
            $table->integer('user_id')->unsigned();     //To track the user or owner of the task
            $table->integer('company_id')->unsigned()->nullable();  //To track the company of the task
            $table->integer('days')->unsigned()->nullable();    //The days of the project and it can be null
            $table->integer('hours')->unsigned()->nullable();    //The length of time of the project and it can be null
            $table->foreign('project_id')->references('id')->on('projects');    //To tell laravel the table of the foreign key
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
