<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // db ye ekleme işlemlerini yapmak iin seedleri burada cağırıyoruz
        $this->call(CategorySeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(PagesSeeder::class);
    }
}
