<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopProductStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopProductStates', function (Blueprint $table) {
            $table->increments('index_id');  
            $table->integer('product_id');    
            $table->string('product_name');   
            $table->integer('product_num');     
            $table->integer('product_price');  
            $table->string('product_image');
            $table->string('user_id'); 
            $table->integer('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopProductStates');
    }
}
