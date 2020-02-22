<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 11; $i++){
	        DB::table('admins')->insert([
	        	'username' => str_random(10),
	        	'password' => '123456789',
	        	'email' => str_random(10).'@gmail.com',
	        	'status' => 1,
	        	'role' => 1,
	        	'avatar' => '',
	        	'address' => '',
	        	'created_at' => date('Y-m-d H:s:s'),
	        	'updated_at' => null
	        ]);
	    }
    }
}
