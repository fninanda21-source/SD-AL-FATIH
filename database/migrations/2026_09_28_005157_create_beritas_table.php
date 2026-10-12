<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori')->default('Prestasi');
            $table->text('excerpt');
            $table->longText('konten');
            $table->string('cover')->nullable();
            $table->string('penulis')->default('Humas SDIT Tahfizh Al-Fatih');
            $table->date('tanggal');
            $table->unsignedInteger('views')->default(0);
            $table->boolean('published')->default(true);
            $table->boolean('featured')->default(false);
            $table->timestamps();

            $table->index(['published', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
