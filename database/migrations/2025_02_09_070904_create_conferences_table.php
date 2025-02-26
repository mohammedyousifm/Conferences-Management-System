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
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->date('registration_deadline');
            $table->string('location')->nullable(); // New field
            // $table->string('organizer_name')->nullable(); // New field
            // $table->string('organizer_email')->nullable(); // New field
            // $table->integer('max_participants')->nullable(); // New field
            $table->enum('status', ['upcoming', 'ongoing', 'completed'])->default('upcoming'); // New field
            // $table->decimal('price', 8, 2)->nullable(); // New field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};
