<?php

use App\Models\Glossary\Division;
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
        Schema::create('glossary__divisions', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('main__users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->nullable()->constrained(Division::getTableName());
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

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

        Schema::create('sys__password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sys__sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys__sessions');
        Schema::dropIfExists('sys__password_reset_tokens');
        Schema::dropIfExists('main__alerts');
        Schema::dropIfExists('main__users');
        Schema::dropIfExists('main__divisions');
    }
};
