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
    Schema::create('riwayat_status', function (Blueprint $table) {
        $table->id();
        $table->foreignId('servis_id')->constrained('servis')->cascadeOnDelete();
        $table->unsignedTinyInteger('status');
        $table->timestamp('waktu')->useCurrent();
        $table->foreignId('diubah_oleh')->constrained('users');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('riwayat_status');
}
};
