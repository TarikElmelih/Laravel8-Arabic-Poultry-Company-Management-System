<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomings', function (Blueprint $table) {
            $table->id();
            $table->string('out_number', 50);
            $table->string('file_name', 999)->default();
            $table->date('out_Date')->nullable();
            $table->string('product', 50);
            $table->bigInteger( 'section_id' )->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->bigInteger( 'product_id' )->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->decimal('price',8,2);
            $table->integer('amount');
            $table->text('source')->nullable()->default('text');
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
        Schema::dropIfExists('incomings');
    }
}
