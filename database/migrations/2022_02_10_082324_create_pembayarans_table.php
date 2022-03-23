<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaksi_id')->unsigned()->nullable();
            $table->double('jumlah_bayar')->default(0);
            $table->enum('metode_bayar',['cash', 'transfer'])->default('cash');
            $table->timestamps();
            $table->foreign('transaksi_id')->references('id')
            ->on('transaksis')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
}
