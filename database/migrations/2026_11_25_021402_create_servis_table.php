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
    Schema::create('servis', function (Blueprint $table) {
        $table->id();
        $table->string('kode_tiket', 12)->nullable()->unique();
        $table->string('nama_pelanggan', 100);
        $table->string('no_wa', 20);
        $table->string('merk_tipe', 100);
        $table->text('keluhan');
        $table->string('kelengkapan', 150)->nullable();
        $table->date('tgl_diterima');
        $table->date('tgl_selesai')->nullable();
        $table->unsignedInteger('harga')->nullable();
        $table->unsignedTinyInteger('status')->default(0);
        $table->foreignId('dibuat_oleh')->constrained('users');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::dropIfExists('servis');
}
};
