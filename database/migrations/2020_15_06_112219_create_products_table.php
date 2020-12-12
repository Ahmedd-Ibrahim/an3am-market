<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->string('image');
            $table->text('desc');
            $table->integer('age');
            $table->float('sale_price');
            $table->enum('feature', ['true','false']);
            $table->integer('stock');
            $table->float('regular_price');
            $table->integer('user_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {

            $table->foreign('user_id')
                ->on('users')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('type_id')
                ->on('types')
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
        Schema::drop('products');
    }
}
