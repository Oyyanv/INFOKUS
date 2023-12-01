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
        Schema::create('orangtua', function (Blueprint $table) {
            $table->string("NIK_Orangtua", 50)->primary();
            $table->string("NIK", 16);
            $table->enum("jk", ['Pria','Wanita']);
            $table->string("Nama", 100);
            $table->text("Alamat");
            $table->string("No_Telp", 20);            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ortus');
    }
};
