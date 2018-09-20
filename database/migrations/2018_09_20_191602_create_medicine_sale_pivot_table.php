<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class App\ extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_sale', function (Blueprint $table) {
            $table->integer('medicine_id')->unsigned()->index();
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
            $table->integer('sale_id')->unsigned()->index();
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->primary(['medicine_id', 'sale_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medicine_sale');
    }
}
