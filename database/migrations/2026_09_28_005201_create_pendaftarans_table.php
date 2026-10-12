<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama_anak');
            $table->string('nisn')->nullable();
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nama_orang_tua');
            $table->string('pekerjaan')->nullable();
            $table->text('alamat');
            $table->string('telepon');
            $table->string('email')->nullable();
            $table->string('sekolah_asal')->nullable();
            $table->string('kelas_tujuan');
            $table->text('catatan')->nullable();
            $table->string('status')->default('baru');
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
