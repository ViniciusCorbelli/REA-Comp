<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('downloads', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('user_id')->default(0);
            $table->foreignId('repository_id')->references('id')->on('repositories')->onDelete('cascade');
            $table->foreignId('file_id')->references('id')->on('files')->onDelete('cascade');

            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('downloads');
    }
}
