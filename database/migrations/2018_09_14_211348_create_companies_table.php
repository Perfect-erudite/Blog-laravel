<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //if(!Schema::hasTable('users')){
        Schema::create('companies', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');  //The name of the company
            $table->longText('description')->nullable();    //The description of the company
            $table->integer('user_id')->unsigned();     //Tracking the owner of the company with a foreign key
            $table->foreign('user_id')->references('id')->on('users');  //Telling laravel the table of the foreign key
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
        Schema::dropIfExists('companies');
    }
}
