<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nomor',20)->unique();
            $table->date('tanggal');
            $table->double('total_harga')->default(0);
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->enum('status',['belum bayar', 'lunas'])->default('belum bayar');
            $table->timestamps();
            $table->foreign('user_id')->references('id')
            ->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
