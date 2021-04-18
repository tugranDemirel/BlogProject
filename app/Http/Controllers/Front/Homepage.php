<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// baglantili oldugu model sayfasını dahil etme(model db islemleri icin kullanılır)
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;

// iletisim kismindan gelen maillerin mail kutumuza dusmesini saglayacagimiz mail kutuphaesi
use Mail;

use Validator;
class Homepage extends Controller
{
    public function __construct()
    {
        // kod tekrarindan kacinmak icin birden fazla fonk da kullandigim kodlari burada kullandim
        view()->share('pages',Page::orderBy('order', 'ASC')->get());
        view()->share('categories',Category::inRandomOrder()->get());
        view()->share('articles',Article::orderBy('created_at', 'DESC')->paginate(10));
    }

    //anasyfamizi calistiran controller
    public function index()
    {
        /* random sira halinde kategorileri getirme
        $data['categories'] = Category::inRandomOrder()->get(); */

//        Blog yazilarini getirme
//        $data['articles'] = Article::orderBy('created_at', 'DESC')->paginate(10);
/*
        $data['pages'] = Page::orderBy('order', 'ASC')->get();
*/
//        ilgili sayfaya db den cekmis odugumuz verileri gonderme islemi
        return view('front.homepage');
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
//        $data['categories'] = Category::inRandomOrder()->get();
        return view('front.single', $data);
    }

    public function category($slug)
    {
//        $data['categories'] = Category::inRandomOrder()->get();
        $category = Category::where('slug',$slug)->first() ?? abort(404, 'Böyle bir kategori bulunamadı');
        $data['category'] = $category;

        // kategoriye ait bloglari getirme
//        $data['articles'] = Article::where('category_id', $category->id)->orderBy('created_at', 'DESC')->paginate(10);


        return view('front.category', $data);
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first() ?? abort(403, 'Böyle bir sayfa bulunamadı');
        $data['page'] = $page;

        return view('front.page', $data);
    }

    public function contact()
    {
        return view('front.contact');
    }


    public function contactpost(Request $request)
    {
        $rules = [
            'name'=>'required|min:5',
            'email'=>'required|email',
            'topic'=>'required',
            'message'=>'required|min:10'
        ];
        $validator = Validator::make($request->post(),$rules);
        if($validator->fails())
        {
            return redirect()->route('contact')->withErrors($validator)->withInput();
        }

        Mail::send([], [], function ($message) use($request){
            $message->from('iletisim@blogsitesi.com', 'Blog Sitesi');
            $message->to('demireltugran66@gmail.com');
            $message->setBody('Mesajı Gönderen:'.$request->name.' <br> Mesajı Gönderen Mail: '.$request->email.'<br> Mesaj Konusu: '.$request->topic.'<br> Mesaj: '.$request->message.'<br><br> Mesaj Gönderilme Tarihi: '.now().' ','text/html');
            $message->subject($request->name.' iletişimden gönderildi.');
        });

       /* $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->topic = $request->topic;
        $contact->message = $request->message;
        $save = $contact->save(); */

        return redirect()->route('contact')->with('success', 'Mesajınız başarıyla iletilmiştir.');


    }

}
