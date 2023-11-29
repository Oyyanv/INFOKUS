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
        Schema::create('siswas', function (Blueprint $table) {
            $table->string("NIS_Kelas", 20)->primary();
            $table->string("NIS", 20);
            $table->string("Nama", 100);
            $table->enum('kelas', ['XA', 'XB', 'XC', 'XD', 'XE', 'XF', 'XG','XIA', 'XIB', 'XIC', 'XID', 'XIE', 'XIF', 'XIG', 
                                    'XIIA', 'XIIB', 'XIIC', 'XIID', 'XIIE', 'XIIF', 'XIIG']);
            $table->enum("Jurusan", ['TJA', 'TKJ', 'TJAT', 'RPL', 'DKV', 'ANIMASI']);
            $table->string("Angkatan", 5);
            $table->timestamps();
            $table->string('NIK_Orangtua', 50)->nullable(); // Sesuaikan tipe data dengan primary key di tabel orangtua
            $table->foreign('NIK_Orangtua')->references('NIK_Orangtua')->on('orangtua')->onDelete('set null');
            // Tambahkan indeks untuk foreign key
            $table->index('NIK_Orangtua');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
