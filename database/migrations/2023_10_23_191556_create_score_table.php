<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoreTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('scores', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedTinyInteger('score');
            $table->foreignId('user_id')->cascade('delete');
            $table->foreignId('repository_id')->cascade('delete');

            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('scores');
    }
}
