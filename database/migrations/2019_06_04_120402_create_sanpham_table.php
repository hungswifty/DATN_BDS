<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('ten_sp',160)->nullable(false);
            $table->integer('id_loaisp')->nullable(false);
            $table->integer('id_khuvuc')->nullable(false);
            $table->integer('id_nguoidung')->nullable(false);
            $table->double('dien_tich', 8, 2);
            $table->double('gia_tien');
            $table->tinyInteger('trang_thai')->default(0);
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
        Schema::dropIfExists('sanpham');
    }
}
