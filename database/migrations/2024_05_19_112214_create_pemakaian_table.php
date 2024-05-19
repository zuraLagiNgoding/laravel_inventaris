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
        Schema::create('pemakaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')
                  ->constrained('barang')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('ruang_id')
                  ->constrained('ruangan')
                  ->onUpdate('cascade')
                  ->onDelete('cascade')
                  ->nullable();
            $table->integer('amount');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemakaian');
    }
};
