<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// baglantili oldugu model sayfasını dahil etme(model db islemleri icin kullanılır)
use App\Models\Category;
use App\Models\Article;

class Homepage extends Controller
{
    //anasyfamizi calistiran controller
    public function index()
    {
        // random sira halinde kategorileri getirme
        $data['categories'] = Category::inRandomOrder()->get();

//        Blog yazilarini getirme
        $data['articles'] = Article::orderBy('created_at', 'DESC')->get();

//        ilgili sayfaya db den cekmis odugumuz verileri gonderme islemi
        return view('front.homepage', $data);
    }

//    blog detay fonk

    public function single($categorySlug,$slug)
    {
        // kategoriy ismi vasıtası ile id ini aldim
        $category = Category::where('slug', $categorySlug)->first() ?? abort(404, 'Böyle bir kategori bulunamadı');

        /* ilgili kategori de ilgili yazi var mi yok mu kontrolu
            Varsa db den verileri al yoksa bırak*/
        $article = Article::where('slug', $slug)->where('category_id', $category->id)->first() ?? abort(404, 'Böyle bir yazı bulunamadı');

        $article->increment('hit');
        $data['article'] = $article;
        // categories leri yolla
        $data['categories'] = Category::inRandomOrder()->get();
        return view('front.single', $data);
    }

}
