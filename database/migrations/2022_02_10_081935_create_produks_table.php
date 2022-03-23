<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('kode',100)->unique();
            $table->bigInteger('kategori_id')->unsigned()->nullable();
            $table->string('nama', 100);
            $table->string('photo')->nullable();
            $table->string('deskripsi')->nullable();
            $table->enum('jenis',['jasa','produk'])->default('produk');
            $table->integer('stok');
            $table->double('harga')->default(0);
            $table->timestamps();
            $table->foreign('kategori_id')->references('id')
                    ->on('kategoris')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
}
