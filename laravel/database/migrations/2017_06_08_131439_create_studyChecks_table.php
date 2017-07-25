<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudyChecksTable extends Migration
{
  
    public function up()
    {
        Schema::create('studyChecks', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('studyid');
            $table->string('playerid');
            $table->boolean('check');
            $table->timestamps();
            
        });
    }

    public function down()
    {
         Schema::dropIfExists('studyChecks');
    }
}
