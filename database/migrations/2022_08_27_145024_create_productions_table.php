<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->string('pro_number', 50);
            $table->date('pro_Date')->nullable();
            $table->bigInteger( 'section_id' )->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->bigInteger( 'product_id' )->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('addproductions')->onDelete('cascade');
            $table->integer('production');
            $table->text('Percentage')->nullable()->default('text');
            $table->integer('debris_store')->nullable();
            $table->integer('ch_store')->nullable();
            $table->integer('debris')->nullable();
            $table->integer('sold')->nullable();
            $table->integer('death_store')->nullable();
            $table->integer('death')->nullable();
            $table->integer('feed')->nullable();
            $table->integer('feed_store')->nullable();
            $table->text('Waste')->nullable();
            $table->text('note')->nullable()->default('text');
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
        Schema::dropIfExists('productions');
    }
}
