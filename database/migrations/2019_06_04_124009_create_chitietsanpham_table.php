<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChitietsanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietsanpham', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_loaihinh');
            $table->integer('id_loaisp');
            $table->integer('id_sanpham');
            $table->integer('so_tang');
            $table->integer('so_phongan');
            $table->integer('so_phongngu');
            $table->integer('so_nhavesinh');
            $table->integer('so_chodexehoi');
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
        Schema::dropIfExists('chitietsanpham');
    }
}
