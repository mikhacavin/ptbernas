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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('slug');
            $table->string('thumbnail');
            $table->text('excerpt');
            $table->text('desc');
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users')->onDelete('restrict'); // Asumsi: ada tabel 'users' untuk author
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');

            // Tambahkan index pada kolom yang sering digunakan
            $table->index('title'); // Index untuk pencarian berdasarkan judul
            $table->unique('slug'); // Unique index untuk memastikan slug unik
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
