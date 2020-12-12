<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->float('price');
            $table->string('serial');
            $table->float('delivery_price');
            $table->float('total_price');
            $table->enum('process', ['prepare','delivery','done']);
            $table->date('delivery_date');
            $table->integer('address_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });

           Schema::table('orders', function (Blueprint $table) {

            $table->foreign('address_id')
                ->on('address')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->on('users')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
