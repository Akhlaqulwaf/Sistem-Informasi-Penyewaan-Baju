<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->unsignedBigInteger('user_id');
            $table->integer('subtotal');
            $table->string('pesan')->nullable();
            $table->unsignedBigInteger('status_order_id');
            $table->unsignedBigInteger('keranjang_id');
            $table->string('metode_pembayaran');
            $table->string('no_hp');
            $table->string('jaminan');
            $table->string('bukti_pembayaran')->nullable();
            $table->string('ambil_brg');
            $table->string('alamat');
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
        Schema::dropIfExists('order');
    }
}
