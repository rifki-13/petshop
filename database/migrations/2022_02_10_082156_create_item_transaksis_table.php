<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_transaksis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaksi_id')->unsigned()->nullable();
            $table->bigInteger('produk_id')->unsigned()->nullable();
            $table->double('jumlah')->default(0);
            $table->double('harga')->default(0);
            $table->double('total_harga')->default(0);
            $table->timestamps();
            $table->foreign('transaksi_id')->references('id')
            ->on('transaksis')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('produk_id')->references('id')
            ->on('produks')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_transaksis');
    }
}
