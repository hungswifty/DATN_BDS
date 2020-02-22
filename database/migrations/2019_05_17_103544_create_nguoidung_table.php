<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNguoidungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('tentaikhoan',60)->nullable(false);
            $table->string('matkhau',60)->nullable(false);
            $table->string('email',60)->unique()->nullable(false);
            $table->string('hoten',40)->nullable(false);
            $table->string('anhdaidien',120);
            $table->tinyInteger('gioitinh')->default(0);
            $table->tinyInteger('status')->default(1);
            //0 mean not activate, 1 is activated 
            $table->string('diachi',60);
            $table->string('so_dt',11);
            $table->string('so_cmnd')->nullable(false);
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
        Schema::dropIfExists('nguoidung');
    }
}
