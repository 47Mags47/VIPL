<?php

use App\Models\Payment\File;
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
        Schema::create('payment__recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')->constrained(File::getTableName())->cascadeOnDelete();

            $table->string('first_name')->nullable();
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->date('d_rojd');
            $table->string('snils');

            $table->string('account');
            $table->float('summ', 2);
            $table->string('kbk');

            $table->string('p_series');
            $table->string('p_number');
            $table->date('p_date');
            $table->text('p_div');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment__recipients');
    }
};
