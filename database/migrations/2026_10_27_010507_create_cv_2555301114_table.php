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
            Schema::create('cv_2555301114', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('nim', 20);
            $table->string('kelas', 50);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->string('posisi', 100);
            $table->string('perusahaan', 100);
            $table->string('periode', 50);
            $table->text('deskripsi')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv_2555301114');
    }
};