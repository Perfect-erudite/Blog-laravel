<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //if(!Schema::hasTable('users')){
        Schema::create('projects', function(Blueprint $table){
            $table->increments('id');
            $table->string('name'); //The name of the project
            $table->longText('description')->nullable();  //The description of the project
            $table->integer('company_id')->unsigned(); //To track the company of the project with a foreign key
            $table->integer('user_id')->unsigned();     //To track the owner of the project with a foreign key
            $table->integer('days')->unsigned()->nullable();    //The length of the project
            $table->foreign('company_id')->references('id')->on('companies');   //Telling laravel the table to get the foreign key from
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        // Schema::table('projects', function($table) {
        //     $table->foreign('user_id')->references('id')->on('users');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
