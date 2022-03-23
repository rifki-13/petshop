<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->unsigned()
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreignId('produk_id')
                ->unsigned()
                ->nullable()
                ->constrained('produks')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->string('deskripsi_reservasi');
            $table->foreignId('tanggal_reservasi')
                ->unsigned()
                ->nullable()
                ->constrained('jadwal_reservasis')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->enum('status_reservasi', ['approved', 'cancelled', 'declined', 'pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservasis');
    }
};
