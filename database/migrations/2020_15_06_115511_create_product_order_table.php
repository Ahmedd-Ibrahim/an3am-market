<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrderTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('count');
            $table->float('price');
            $table->timestamps();
        });

         Schema::table('product_order', function (Blueprint $table) {

             $table->foreign('product_id')
                 ->on('products')
                 ->references('id')
                 ->onUpdate('cascade')
                 ->onDelete('cascade');

             $table->foreign('order_id')
                 ->on('orders')
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
        Schema::drop('product_order');
    }
}
