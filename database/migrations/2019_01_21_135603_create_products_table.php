<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('name_url', 255);
            $table->string('image', 255);
            $table->string('price', 20);
            $table->integer('category_id', false, true);
            $table->integer('vendor_id', false, true);
            $table->text('description');
            $table->integer('avail_flg', false, true)->nullable()->default('1');
            $table->integer('status', false, true)->nullable()->default('0');
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
        //
    }
}
