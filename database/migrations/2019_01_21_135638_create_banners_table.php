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
            $table->string('banner', 255)->nullable();
            $table->string('description', 300)->nullable();
            $table->string('link', 255)->nullable();
            $table->string('youtube_url', 255)->nullable();
            $table->integer('avail_flg', false, true)->nullable()->default('1');
            $table->string('select_type', '20')->nullable();
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
