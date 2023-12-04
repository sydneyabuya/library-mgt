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
        Schema::table('books', function (Blueprint $table) {
            $table->foreignId('author_id')->after('title')->nullable()->constrained('author');
            $table->foreignId('tag_id')->nullable()->constrained('tag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->foreignId('author_id')->after('title')->nullable()->constrained('author');
            $table->foreignId('tag_id')->nullable()->constrained('tag');
        });
    }
};
