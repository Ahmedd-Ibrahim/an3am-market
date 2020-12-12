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
            $table->string('intro_ar_photo');
            $table->string('intro_en_photo');
            $table->text('intro_ar_title');
            $table->text('intro_en_title');
            $table->text('intro_ar_desc');
            $table->text('intro_en_desc');
            $table->longText('about_ar');
            $table->longText('about_en');
            $table->longText('condation_ar');
            $table->longText('condation_en');
            $table->longText('privcy_ar');
            $table->longText('privcy_en');
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
