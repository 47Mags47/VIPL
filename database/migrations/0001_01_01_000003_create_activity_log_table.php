<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration
{
    public function up()
    {
        Schema::create('laravel__activity_log', function (Blueprint $table) {
            $table->id('id');
            $table->string('log_name')->nullable();
            $table->text('description');
            $table->string('subject_type');
            $table->string('subject_id');
            $table->string('causer_type')->nullable();
            $table->integer('causer_id')->nullable();
            $table->json('properties')->nullable();
            $table->timestamps();
            $table->index('log_name');
            $table->string('event')->nullable();
            $table->uuid('batch_uuid')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laravel__activity_log');
    }
}
