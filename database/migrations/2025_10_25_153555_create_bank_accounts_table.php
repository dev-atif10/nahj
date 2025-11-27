<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration 
{ 
    public function up(): void
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // ربط بالمستخدم
            $table->string('bank_name');                // اسم البنك
            $table->string('account_holder_name');      // اسم صاحب الحساب البنكي
            $table->string('account_number');           // رقم الحساب
            $table->string('iban')->nullable();         // رقم الإيبان  
            $table->string('swift_code')->nullable();   // سويفت كود
            $table->string('country');                  // الدولة
            $table->boolean('is_primary')->default(false);  // هل هو الحساب الأساسي؟
            $table->timestamps();
            $table->softDeletes();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
