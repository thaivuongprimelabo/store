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
            $table->string('banner_image_size', 20)->nullable()->default('');
            $table->string('vendor_image_size', 20)->nullable()->default('');
            $table->string('product_image_size', 20)->nullable()->default('');
            $table->string('post_image_size', 20)->nullable()->default('');
            $table->string('banner_maximum_upload', 20)->nullable()->default('51200');
            $table->string('vendor_maximum_upload', 20)->nullable()->default('51200');
            $table->string('product_maximum_upload', 20)->nullable()->default('51200');
            $table->string('post_maximum_upload', 20)->nullable()->default('51200');
            $table->string('attachment_maximum_upload', 20)->nullable()->default('51200');
            $table->integer('off')->nullable()->default(1);
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
