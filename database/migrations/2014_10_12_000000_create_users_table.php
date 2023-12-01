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
            $table->enum('status', ['siswa', 'admin'])->default('siswa');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // Foreign key untuk siswa
            $table->string('NIS_Angkatan', 20)->nullable();
            $table->foreign('NIS_Angkatan')->references('NIS_Angkatan')->on('siswas')->onDelete('set null');

            // Foreign key untuk guru/staff
            $table->unsignedBigInteger('id_nip')->nullable();
            $table->foreign('id_nip')->references('id_nip')->on('gurustaffs')->onDelete('set null');
            //index untuk menyambungkan foreignnya
            $table->index('NIS_Angkatan');
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
