<?php

use App\Constants\Common;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Common::BANNERS, function (Blueprint $table) {
            $table->increments('id');
            $table->string('banner', 255);
            $table->string('description', 300);
            $table->string('link', 255);
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
