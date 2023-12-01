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
            $table->date('tgl_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('total_pembayaran');
            $table->enum('status', ['Lunas','Menunggu Konfirmasi', 'Belum Bayar']);
            $table->timestamps();

           //foreign table siswa
            $table->string('NIS_Angkatan', 20)->nullable();
            $table->foreign('NIS_Angkatan')->references('NIS_Angkatan')->on('siswas')->onDelete('set null');

            //foreign table guru/staff
            $table->unsignedBigInteger('id_nip')->nullable();
            $table->foreign('id_nip')->references('id_nip')->on('gurustaffs')->onDelete('set null');

            //foreign table tagihan
            $table->unsignedBigInteger('id_tagihan')->nullable();
            $table->foreign('id_tagihan')->references('id_tagihan')->on('tagihans')->onDelete('set null');

            //index dari masing masing table untuk merelasikan foreign
            $table->index('NIS_Angkatan');
            $table->index('id_nip');
            $table->index('id_tagihan');
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
