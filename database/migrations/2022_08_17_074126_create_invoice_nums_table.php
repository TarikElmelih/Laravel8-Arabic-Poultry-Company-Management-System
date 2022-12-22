<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceNumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_nums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger( 'section_id' )->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->unsignedBigInteger('mix_id')->nullable();
            $table->foreign('mix_id')->references('id')->on('mixes')->onDelete('cascade');
            $table->date('mixture_Date')->nullable();
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
        Schema::dropIfExists('invoice_nums');
    }
}
