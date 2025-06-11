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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('id_kategori')->constrained('kategori')->onDelete('cascade');
            $table->foreignId('id_umkm')->constrained('umkm')->onDelete('cascade');
            $table->decimal('rating', 2, 1);
            $table->bigInteger('price');
            $table->text('description');
            $table->string('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};