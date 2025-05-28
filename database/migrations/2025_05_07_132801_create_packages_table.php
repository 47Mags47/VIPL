<?php

use App\Models\Glossary\Division;
use App\Models\Glossary\PackageStatus;
use App\Models\Payment\Event;
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
        Schema::create('glossary__package_status', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
        });

        Schema::create('payment__packages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('division_id')->constrained(Division::getTableName());
            $table->foreignId('event_id')->constrained(Event::getTableName());
            $table->foreignId('status_id')->constrained(PackageStatus::getTableName());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment__packages');
        Schema::dropIfExists('glossary__package_status');
    }
};
