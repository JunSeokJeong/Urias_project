<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('shops', function (Blueprint $table) {
            $table->increments('product_id');   //상품번호 
            $table->string('product_name');     //상품이름
            $table->text('product_contents');   //상품 설명
            $table->integer('product_num');     //상품 수량
            $table->integer('product_price');   //상품 가격
            $table->string('product_iamge');    //상품 이미지  - 파일 이름
            // $table->renameColumn('product_iamge', 'product_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
