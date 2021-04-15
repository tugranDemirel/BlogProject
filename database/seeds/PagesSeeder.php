<?php

use Illuminate\Database\Seeder;
// db kutuphanesi dahil edilmesi
use Illuminate\Support\Facades\DB;
class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $pages= ['Hakkımızda', 'Kariyer', 'Vizyonumuz', 'Misyonumuz'];
        $i = 0;
        foreach ($pages as $page)
        {
            $i++;
            DB::table('pages')->insert([
                'title' =>$page,
                'image'=>'https://lh3.googleusercontent.com/proxy/jpcIEbCxUdzMyMvE092kgh3_bDyavdsir9F_LjepdlbAo-BxtORrnEKAYf11Ueh11bm9RMMO7MRpf4XfFBA0mR-SFe7AQO2hBXZiE_DpY2s98GsPtHRQB_0ame4O81BRrntqfg',
                'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Adipisci alias aperiam aut dolorum facere inventore mollitia,
                            quaerat soluta velit veritatis. Aperiam deserunt dolorem
                            eaque incidunt labore quam quidem ratione similique?',
                'slug' =>str_slug($page),
                'order'=>$i,
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
    }
}
