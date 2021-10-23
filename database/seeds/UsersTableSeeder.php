<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
            'name' => 'Tom Printy',
            'email' => 'tprinty@edisonave.com',
            'password' => bcrypt('iPhone1234!'),
        ]);
        DB::table('users')->insert([
            'name' => 'John Biggs',
            'email' => 'john@bigwidelogic.com',
            'password' => bcrypt('jbbw1234!'),
        ]);
        
    }
}
