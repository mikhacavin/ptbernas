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
        Schema::create('testimonial_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_feedback_id')->nullable();
            $table->unsignedBigInteger('rating');
            $table->string('name');
            $table->string('position');
            $table->text('desc');
            $table->unsignedBigInteger('show')->default(0);
            $table->timestamps();

            $table->foreign('client_feedback_id')->references('id')->on('client_feedback')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonial_lists');
    }
};
