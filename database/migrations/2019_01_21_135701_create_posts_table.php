<?php

use App\Constants\Common;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create(Common::POSTS, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('name_url', 255);
            $table->string('description', 255);
            $table->text('content');
            $table->string('photo', 255);
            $table->string('published_at', 12)->nullable();
            $table->string('published_time_at', 4)->nullable();
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
