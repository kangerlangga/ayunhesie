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
        Schema::create('blogs', function (Blueprint $table) {
            $table->string('id_blog')->primary();
            $table->string('id_detail')->unique();
            $table->string('title_blog');
            $table->longText('content_blog');
            $table->string('thumbnail_blog');
            $table->string('author_blog');
            $table->string('visib_blog');
            $table->string('created_by');
            $table->string('modified_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
