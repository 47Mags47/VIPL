<?php

use App\Models\Main\AlertType;
use App\Models\Main\User;
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
        Schema::create('glossary__alert_types', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
        });

        Schema::create('main__alerts', function (Blueprint $table) {
            $table->id();
            $table->string('message');

            $table->foreignId('to_id')->constrained(User::getTableName());
            $table->foreignId('type_id')->constrained(AlertType::getTableName());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main__alerts');
        Schema::dropIfExists('glossary__alert_types');
    }
};
