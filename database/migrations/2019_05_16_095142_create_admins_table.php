<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id')->unsigned(); // tu dong tang khong am
            $table->string('username',60)->unique(); //khong trung nhau 
            $table->string('password',60);
            $table->string('email',60)->unique();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('role')->default(0);
            $table->string('avatar',120);
            $table->text('address');
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
        Schema::dropIfExists('admins');
    }
}
