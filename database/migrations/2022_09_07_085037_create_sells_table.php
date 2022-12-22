<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->id();
            $table->bigInteger( 'section_id' )->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->string('file_name', 999)->default();
            $table->integer('production')->nullable()->default(12);
            $table->text('box')->nullable()->default('text');
            $table->text('number')->nullable()->default('text');
            $table->text('price')->nullable()->default('text');
            $table->text('Weight')->nullable()->default(12);
            $table->text('name')->nullable()->default('text');
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
        Schema::dropIfExists('sells');
    }
}
