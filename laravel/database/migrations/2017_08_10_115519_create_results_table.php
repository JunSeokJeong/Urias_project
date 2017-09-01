<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('results', function (Blueprint $table) {
           $table->increments('id'); 
           $table->integer('count');
            $table->integer('userid');
            $table->integer('quiznum');  
            $table->integer('example');
            $table->integer('answer');     
            $table->integer('choice');  
           
          
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
        Schema::dropIfExists('results');
    }
}
