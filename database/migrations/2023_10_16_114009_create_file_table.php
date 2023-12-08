<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;

class CreateFileTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Storage::deleteDirectory('repository');
        Storage::deleteDirectory('tmp');

        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->string('path');
            $table->integer('size');
            $table->foreignId('repository_id')->references('id')->on('repositories')->onDelete('cascade');

            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('files');
    }
}
