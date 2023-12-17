<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable(true);
            $table->bigInteger('album_id');

            $table->string('type');

            $table->string('author');
            $table->string('name');
            $table->text('description');
            $table->string('cover_url');
            $table->timestamp('time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albumlogs');
    }
};
