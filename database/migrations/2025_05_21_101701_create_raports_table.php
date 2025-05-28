<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('main__raports', function (Blueprint $table) {
            $table->id();
            $table->string('disk')->default('local');
            $table->string('path');
            $table->string('name');
            $table->text('comment');

            $table->integer('start_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main__raports');
    }
};
