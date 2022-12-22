<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddproductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addproductions', function (Blueprint $table) {
            $table->id();
            $table->text('amount');
            $table->text('chAmount');
            $table->text('production');
            $table->text('chproduction');
            $table->text('Waste');
            $table->text('feed');
            $table->text('chfeed');
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
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
        Schema::dropIfExists('addproductions');
    }
}
