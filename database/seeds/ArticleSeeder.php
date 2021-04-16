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
        //            Faker kutuphanesi olusturulması
        $faker = Faker::create();
        for ($i = 0; $i < 21; $i++)
        {

            $title = $faker->sentence(6);
            DB::table('articles')->insert([
                'category_id'=>rand(1,7),
                'title'=>$title,
                'image'=>$faker->imageUrl($width = 800, $height = 400, 'cats', true),
                'content'=>$faker->paragraph(6),
                'slug'=>str_slug($title),
                'created_at'=>$faker->dateTime('now'),
                'updated_at'=>now()

            ]);
        }
    }
}
