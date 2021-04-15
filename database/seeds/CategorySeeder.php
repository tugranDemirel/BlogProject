<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = ['Eğlence', 'Bilişi', 'Gezi', 'Teknoloji', 'Sağlık', 'Spor', 'Günlük Yaşam'];
        foreach ($categories as $item)
        {
            DB::table('categories')->insert([
                'name' =>$item,
                'slug' =>str_slug($item)
            ]);
        }
    }
}
