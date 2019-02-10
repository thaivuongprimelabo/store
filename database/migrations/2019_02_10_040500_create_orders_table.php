<?php

use App\Constants\Common;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create(Common::ORDERS, function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name', 255)->nullable()->default('');
            $table->string('customer_email', 255)->nullable()->default('');
            $table->string('customer_address', 255)->nullable()->default('');
            $table->string('customer_phone', 255)->nullable()->default('');
            $table->string('payment_method', 20)->nullable()->default('');
            $table->integer('status')->nullable()->default(0);
            $table->decimal('total', 10, 0)->nullable()->default(0);
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
