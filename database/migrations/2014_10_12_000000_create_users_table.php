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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('email')->unique();
            $table->enum('status', ['siswa','admin'])->default('siswa');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            //siswa
            $table->string('NIS_Angkatan', 20)->nullable(); // Sesuaikan tipe data dengan primary key di tabel orangtua
            $table->foreign('NIS_Angkatan')->references('NIS_Angkatan')->on('siswas')->onDelete('set null');
            // Tambahkan indeks untuk foreign key
            $table->index('NIS_Angkatan');
            //guru/staff
            $table->string('id_nip', 20)->nullable(); // Sesuaikan tipe data dengan primary key di tabel orangtua
            $table->foreign('id_nip')->references('id_nip')->on('gurustaffs')->onDelete('set null');
            // Tambahkan indeks untuk foreign key
            $table->index('id_nip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
