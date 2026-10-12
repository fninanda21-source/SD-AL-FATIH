<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tingkat');
            $table->foreignId('wali_kelas_id')->nullable()->constrained('gurus')->nullOnDelete();
            $table->string('warna')->default('#059669');
            $table->unsignedSmallInteger('kapasitas')->default(28);
            $table->unsignedSmallInteger('terisi')->default(0);
            $table->text('deskripsi')->nullable();
            $table->json('fasilitas')->nullable();
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
