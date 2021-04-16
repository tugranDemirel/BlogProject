<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

            DB::table('admins')->insert([
                'name' =>'Tuğran Demirel',
                'email' =>'demireltugran66@gmail.com',
                'password' =>bcrypt('1289558T.d'),
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
    }
}
