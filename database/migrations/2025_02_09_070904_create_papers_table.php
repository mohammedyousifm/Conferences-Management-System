<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('papers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('conference_id')->constrained()->onDelete('cascade');
            $table->foreignId('reviewer_id')->nullable()->constrained('users')->onDelete('set null'); // Reviewer ID (optional)
            $table->string('title');
            $table->text('abstract');
            $table->string('file_path');
            $table->string('file_type')->nullable(); // PDF, DOCX, etc.
            $table->integer('version')->default(1); // Paper version
            $table->text('keywords')->nullable(); // Related topics
            $table->timestamp('submission_date')->nullable(); // When it was submitted
            $table->text('review_feedback')->nullable(); // Reviewer's comments
            $table->enum('status', ['submitted', 'under_review', 'accepted', 'rejected'])->default('submitted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('papers');
    }
};
