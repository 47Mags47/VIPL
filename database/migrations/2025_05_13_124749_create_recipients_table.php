<?php

use App\Models\Main\Payment\File;
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
        Schema::create('main__payment__recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->constrained(File::getTableName())->onDelete('cascade');

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->date('d_rojd')->nullable();
            $table->string('snils')->nullable();

            $table->string('account')->nullable();
            $table->float('summ', 2)->nullable();

            $table->string('p_series')->nullable();
            $table->string('p_number')->nullable();
            $table->date('p_date')->nullable();
            $table->text('p_div')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main__payment__recipients');
    }
};
