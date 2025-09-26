<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rankings', function (Blueprint $table) {
            $table->id();
            $table->string('team');
            $table->unsignedInteger('played');
            $table->unsignedInteger('won');
            $table->unsignedInteger('draw');
            $table->unsignedInteger('lost');
            $table->unsignedInteger('goals_for');
            $table->unsignedInteger('goals_against');
            $table->integer('goal_diff');
            $table->unsignedInteger('points');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rankings');
    }
};


