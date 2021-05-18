<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AdminSeeder extends Seeder
{
    /**
     * Run the Database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table("users")->insert([
            'name'=>'Admin',
            'email'=>'admin@anglara.com',
            'password'=> bcrypt('password'),
        ]);

    }
    
}
