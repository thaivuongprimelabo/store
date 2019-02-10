<?php

use App\Constants\Common;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create(Common::ORDER_DETAILS, function (Blueprint $table) {
            $table->integer('order_id', false, true);
            $table->integer('product_id', false, true);
            $table->integer('qty', false, true);
            $table->decimal('price', 10, 0);
            $table->decimal('cost', 10, 0);
            $table->string('sizes', 255);
            $table->string('colors', 255);
            $table->timestamps();
            $table->primary(['order_id', 'product_id']);
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
