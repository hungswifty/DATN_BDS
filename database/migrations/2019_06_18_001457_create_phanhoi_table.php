<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhanhoiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phanhoi', function (Blueprint $table) {
             $table->increments('id')->unsigned();
             $table->integer('id_sanpham')->nullable(false);
             $table->string('noi_dung', 300);
             $table->string('email', 60);
             $table->string('so_dt', 11);
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
        Schema::dropIfExists('table');
    }
}
