<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// baglantili oldugu model sayfasını dahil etme(model db islemleri icin kullanılır)
use App\Models\Category;

class Homepage extends Controller
{
    //anasyfamizi calistiran controller
    public function index()
    {
        // random sira halinde kategorileri getirme
        $data['categories'] = Category::inRandomOrder()->get();
//        ilgili sayfaya db den cekmis odugumuz verileri gonderme islemi
        return view('front.homepage', $data);
    }
}
