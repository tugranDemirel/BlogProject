<?php

use Illuminate\Database\Seeder;
// faker kutuphanesi dahil edilmesi
use Faker\Factory as Faker;
// db kutuphanesi dahil edilmesi
use Illuminate\Support\Facades\DB;
class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i < 4; $i++)
        {
//            Faker kutuphanesi olusturulması
            $faker = Faker::create();
            DB::table('articles')->insert([
                'category_id'=>rand(1,7),
                'title'=>$faker->title,
                'image'=>$faker->imageUrl($width = 800, $height = 400, 'cats', true, 'Faker'),
                'content'=>$faker->text,
                'slug'=>str_slug($faker->title),
                'created_at'=>now(),
                'updated_at'=>now()

            ]);
        }
    }
}
