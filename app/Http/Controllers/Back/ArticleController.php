<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// yazıların baglı oldugu modeli cagırdık. onun uzerinden veri transferi yapacğım
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles = Article::orderBy('created_at', 'DESC')->get();
        return view('back.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('back.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Gelen bilgileri yakalam sayfası

        $request->validate([
            'title'=>'min:3',
            'image'=>'required|mimes:jpeg,png,jpg|max:500000'
        ]);

        /* Article modelinden yeni bir nesne turettim(db ye erisim yetkisi sagladım)*/
        $article = new Article;
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->contentt;
        $article->slug = str_slug($request->title);

        // secili resim var mi yok mu ?
        if($request->hasFile('image'))
        {
            /* getClientOriginalExtension => uzantıyı verir*/
            $imageName = str_slug($request->title).".".$request->image->getClientOriginalExtension();
            /* Resimin upload olacagi klasor ve isim*/
            $request->image->move(public_path('uploads'), $imageName);

            $article->image = $imageName;
        }
        $article->save();

        toastr()->success('Makale başarııyla oluşturuldu.', 'Başarılı');

        return redirect()->route('admin.makaleler.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return 'Tüm makalele detayın gösterileceiği show sayfası';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = Category::all();
        // ilgili makale yoksa findOrFail ile 404 sayfasına yönlendirme yapabiliyoruz
        $article = Article::findOrFail($id);
        return view('back.articles.edit', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'mimes:jpeg,png,jpg|max:500000'
        ]);

        /* Article modelinden yeni bir nesne turettim(db ye erisim yetkisi sagladım)*/
        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->contentt;
        $article->slug = str_slug($request->title);

        // secili resim var mi yok mu ?
        if($request->hasFile('image'))
        {
            /* getClientOriginalExtension => uzantıyı verir*/
            $imageName = str_slug($request->title).".".$request->image->getClientOriginalExtension();
            /* Resimin upload olacagi klasor ve isim*/
            $request->image->move(public_path('uploads'), $imageName);

            $article->image = $imageName;
        }
        $article->save();

        toastr()->success('Makale başarııyla güncellendi.', 'Başarılı');

        return redirect()->route('admin.makaleler.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return 'Tüm makalelenin silineceği delete sayfası';
    }

    // status ddegistirme
    public function switch(Request $request)
    {
        $article = Article::findOrFail($request->id);
        $article->status = $request->statu == 'true' ? 1 : 0;
        $article->save();
    }
}
