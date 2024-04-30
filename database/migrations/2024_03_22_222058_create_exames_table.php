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
            Schema::create('exames', function (Blueprint $table) {
                $table->id();
                $table->string('exam_code');
                $table->foreignId('user_id');
                $table->string('title');
                $table->string('count');
                $table->string('name');
                $table->boolean('rand_choice');
                $table->boolean('rand_que');
                $table->date('date');
                $table->time('time');
                $table->string('deadline');
                $table->string('type');
                $table->boolean('presses')->default(0);
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
        Schema::dropIfExists('exames');
    }
};
