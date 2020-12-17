<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('intro_ar_photo')->nullable();
            $table->string('intro_en_photo')->nullable();
            $table->text('intro_ar_title')->nullable();
            $table->text('intro_en_title')->nullable();
            $table->text('intro_ar_desc')->nullable();
            $table->text('intro_en_desc')->nullable();
            $table->longText('about_ar')->nullable();
            $table->longText('about_en')->nullable();
            $table->longText('condation_ar')->nullable();
            $table->longText('condation_en')->nullable();
            $table->longText('privcy_ar')->nullable();
            $table->longText('privcy_en')->nullable();
            $table->float('delivery_price')->default(0);
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
        Schema::drop('settings');
    }
}
