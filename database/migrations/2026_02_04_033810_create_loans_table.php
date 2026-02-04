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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['given', 'taken']); // given = money lent to others, taken = money borrowed
            $table->decimal('amount', 10, 2);
            $table->date('date');
            $table->date('due_date')->nullable();
            $table->string('person'); // The other party involved
            $table->text('description')->nullable();
            $table->boolean('is_settled')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
