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
        Schema::create('gurustaffs', function (Blueprint $table) {
            $table->string('NIP', 20)->primary();
            $table->string('nama', 100);
            $table->enum('status', ['Guru', 'Staff']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurustaffs');
    }
};
