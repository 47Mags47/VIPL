<?php

use App\Models\Main\User;
use App\Models\Sys\Permission;
use App\Models\Sys\Role;
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
        Schema::create('sys__roles', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('sys__permissions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('main__user_pivot_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(User::getTableName());

            $table->string('role_code');
            $table->foreign('role_code')->references('code')->on(Role::getTableName());

            $table->timestamps();
        });

        Schema::create('main__user_pivot_permission', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(User::getTableName());

            $table->string('permission_code');
            $table->foreign('permission_code')->references('code')->on(Permission::getTableName());

            $table->timestamps();
        });

        Schema::create('sys__role_pivot_permission', function (Blueprint $table) {
            $table->id();
            $table->string('role_code');
            $table->foreign('role_code')->references('code')->on(Role::getTableName());
            $table->string('permission_code');
            $table->foreign('permission_code')->references('code')->on(Permission::getTableName());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys__role_pivot_permission');
        Schema::dropIfExists('main__user_pivot_permission');
        Schema::dropIfExists('main__user_pivot_role');
        Schema::dropIfExists('sys__permissions');
        Schema::dropIfExists('sys__roles');
    }
};
