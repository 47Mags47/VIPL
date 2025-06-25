<?php

use App\Models\Glossary\ValidatorColumnType;
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
        Schema::create('glossary__validator_column_types', function (Blueprint $table) {
            $table->id();
            $table->string('code');
        });

        Schema::create('glossary__validator_columns', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->integer('file_pos')->unique();
            $table->boolean('required');
            $table->json('patterns')->nullable();

            $table->foreignId('type_id')->constrained(ValidatorColumnType::getTableName());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('glossary__validator_columns');
        Schema::dropIfExists('glossary__validator_column_types');
    }
};
