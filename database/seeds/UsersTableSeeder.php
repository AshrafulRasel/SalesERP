<?php

use Illuminate\Database\Seeder;
 use Illuminate\Support\Facades\DB;
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
            'f_name' => "Admin",
            'l_name' => "User",
            'image' => "user.jpg",
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);


    }
}
