<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizListsTable extends Migration
{
    
    public function up()
    {
        Schema::create('quizLists', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('title');
            $table->string('filesrc');
        });
    }

    public function down()
    {
       Schema::dropIfExists('quizLists');
    }
}
