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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->string('NIP')->nullable();
            $table->string('NIS')->nullable();
            $table->string('email')->nullable();
            $table->date('tgl_pembayaran')->nullable();
            $table->enum('bulan', ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
            'September', 'Oktober', 'November', 'Desember']);
            $table->string('bukti_pembayaran')->nullable();
            $table->string('total_pembayaran')->nullable();
            $table->string('total_tagihan');
            $table->enum('status', ['Lunas','Menunggu Konfirmasi', 'Belum Bayar']);
            $table->timestamps();

           //foreign table siswa
            $table->string('NIS_Angkatan', 20)->nullable();
            $table->foreign('NIS_Angkatan')->references('NIS_Angkatan')->on('siswas')->onDelete('set null');

            //index dari masing masing table untuk merelasikan foreign
            $table->index('NIS_Angkatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
