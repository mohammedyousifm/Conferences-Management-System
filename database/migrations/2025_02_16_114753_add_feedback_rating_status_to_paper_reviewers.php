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
        Schema::table('paper_reviewer', function (Blueprint $table) {
            $table->text('feedback')->nullable(); // Allows storing review feedback
            $table->integer('rating')->nullable()->unsigned()->comment('Rating from 1 to 5');
            $table->enum('status', ['Received', 'Completed', 'Under_review'])->nullable();
        });
    }

    public function down()
    {
        Schema::table('paper_reviewer', function (Blueprint $table) {
            $table->dropColumn(['feedback', 'rating', 'status']);
        });
    }
};
