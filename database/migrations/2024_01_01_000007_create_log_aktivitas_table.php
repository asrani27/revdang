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
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('aktivitas', 255)->comment('Deskripsi aktivitas yang dilakukan');
            $table->string('modul', 100)->nullable()->comment('Modul yang diakses (admin, petugas, pelanggan)');
            $table->string('IP_address', 45)->nullable()->comment('Alamat IP user');
            $table->text('user_agent')->nullable()->comment('Browser/Device info');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            
            // Index untuk performa query
            $table->index('user_id');
            $table->index('modul');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};
