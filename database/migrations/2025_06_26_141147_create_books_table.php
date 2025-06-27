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
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // Kolom ID auto-increment
            $table->string('name'); // Menggantikan 'title' untuk nama buket
            $table->text('description')->nullable(); // Deskripsi bunga, wrapping, dll.
            $table->decimal('price', 10, 2); // Menggantikan 'double' untuk harga (lebih akurat untuk uang)
            $table->string('image')->nullable(); // Menggantikan 'cover' untuk path foto buket
            
            $table->timestamp('created_at')->useCurrent(); 
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bouquets');
    }
};
