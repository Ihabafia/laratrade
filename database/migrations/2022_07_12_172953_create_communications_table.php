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
        Schema::create('communications', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->index();
            $table->string('type', 10);
            $table->string('model')->nullable();
            $table->string('title');
            $table->string('subject')->nullable();
            $table->longText('body')->nullable();
            $table->string('method')->nullable();
            $table->json('variables')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('communications');
    }
};
