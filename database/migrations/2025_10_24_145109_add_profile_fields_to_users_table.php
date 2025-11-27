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
        Schema::table('users', function (Blueprint $table) {
        $table->string('nationality')->nullable();
        $table->enum('gender', ['male','female','other'])->nullable();
        $table->integer('age')->nullable();
        $table->string('passport_number')->nullable();
        $table->string('mobile_number')->nullable();
        $table->string('heir_mobile_number')->nullable();
        $table->string('heir_name')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'nationality',
            'gender',
            'age',
            'passport_number',
            'mobile_number',
            'heir_mobile_number',
            'heir_name',
        ]);
    });
    }
};
