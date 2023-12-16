<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('visits', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->date('date');
            $table->foreignId('repository_id')->references('id')->on('repositories')->onDelete('cascade');
            $table->integer('quantity')->default(0);

            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('visits');
    }
}
