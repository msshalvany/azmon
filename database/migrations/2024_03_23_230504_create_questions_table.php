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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exame_id');
            $table->string('type');
            $table->text('text');
            $table->string('image')->nullable();
            $table->text('chose1')->nullable();
            $table->text('chose2')->nullable();
            $table->text('chose3')->nullable();
            $table->text('chose4')->nullable();
            $table->text('answer')->nullable();
            $table->string('level')->nullable();
            $table->string('fasl')->nullable();
            $table->string('chose1img')->nullable();
            $table->string('chose2img')->nullable();
            $table->string('chose3img')->nullable();
            $table->string('chose4img')->nullable();
            $table->string('term')->nullable();
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
        Schema::dropIfExists('questions');
    }
};
