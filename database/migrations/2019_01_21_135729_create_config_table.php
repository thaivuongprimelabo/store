<?php

use App\Constants\Common;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create(Common::CONFIG, function (Blueprint $table) {
            $table->increments('id');
            $table->string('web_title', 255)->nullable()->default('');
            $table->string('web_description', 255)->nullable()->default('');
            $table->string('web_keywords', 255)->nullable()->default('');
            $table->string('web_logo', 255)->nullable()->default('');
            $table->string('web_ico', 255)->nullable()->default('');
            $table->string('web_email', 255)->nullable()->default('');
            $table->string('mail_driver', 20)->nullable()->default('smtp');
            $table->string('mail_host', 50)->nullable()->default('smtp.gmail.com');
            $table->string('mail_port', 10)->nullable()->default('587');
            $table->string('mail_from', 100)->nullable()->default('admin@admin.com');
            $table->string('mail_name', 100)->nullable()->default('System');
            $table->string('mail_encryption', 20)->nullable()->default('tls');
            $table->string('mail_account', 150)->nullable()->default('admin@gmail.com');
            $table->string('mail_password', 150)->nullable()->default('123456789');
            $table->string('banner_image_size', 20)->nullable()->default('698x328');
            $table->string('logo_image_size', 20)->nullable()->default('120x45');
            $table->string('image_image_size', 20)->nullable()->default('207x268');
            $table->string('photo_image_size', 20)->nullable()->default('100x100');
            $table->string('web_logo_image_size', 20)->nullable()->default('224x151');
            $table->string('avatar_image_size', 20)->nullable()->default('25x25');
            $table->string('banner_maximum_upload', 20)->nullable()->default('51200');
            $table->string('logo_maximum_upload', 20)->nullable()->default('51200');
            $table->string('image_maximum_upload', 20)->nullable()->default('51200');
            $table->string('photo_maximum_upload', 20)->nullable()->default('51200');
            $table->string('attachment_maximum_upload', 20)->nullable()->default('51200');
            $table->string('web_logo_maximum_upload', 20)->nullable()->default('51200');
            $table->string('avatar_maximum_upload', 20)->nullable()->default('51200');
            $table->integer('off')->nullable()->default(1);
            $table->string('url_ext', 20)->nullable()->default('.html');
            $table->string('bank_info', 255)->nullable()->default('');
            $table->string('cash_info', 255)->nullable()->default('');
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
