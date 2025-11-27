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
  
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->enum('status', ['pending', 'in_progress', 'completed']);
        $table->enum('priority', ['low', 'medium', 'high']);
        $table->date('start_date');
        $table->date('end_date');
        $table->decimal('budget', 15, 2);
        $table->foreignId('owner_id')->constrained('users')->nullable();
        $table->timestamps();
        $table->foreignId('updated_by')->nullable()->constrained('users');
    });
}

    public function owner()
{
    return $this->belongsTo(User::class, 'owner_id');
}

public function updatedBy()
{
    return $this->belongsTo(User::class, 'updated_by');
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
