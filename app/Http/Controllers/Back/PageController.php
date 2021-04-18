<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\File;
class PageController extends Controller
{
    //
    public function index()
    {
        $pages = Page::orderBy('order', 'ASC')->get();
        return view('back.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('back.pages.create');
    }

    public function post(Request $request)
    {
        // Gelen bilgileri yakalam sayfası

        $request->validate([
            'title'=>'min:3',
            'image'=>'required|mimes:jpeg,png,jpg|max:500000'
        ]);

        // sayfa siralamasi icin sonuncu sayfanin order ini aldik ve sayfa numaralandirma islemine onun uzerinden devam ettik
        $lastPage = Page::orderBy('order', 'desc')->first();
        /* Page modelinden yeni bir nesne turettim(db ye erisim yetkisi sagladım)*/
        $page = new Page;
        $page->title = $request->title;
        $page->content = $request->contentt;
        $page->order = $lastPage->order + 1;
        $page->slug = str_slug($request->title);

        // secili resim var mi yok mu ?
        if($request->hasFile('image'))
        {
            /* getClientOriginalExtension => uzantıyı verir*/
            $imageName = str_slug($request->title).".".$request->image->getClientOriginalExtension();
            /* Resimin upload olacagi klasor ve isim*/
            $request->image->move(public_path('uploads'), $imageName);

            $page->image = $imageName;
        }
        $page->save();

        toastr()->success('Sayfa başarıyla oluşturuldu.', 'Başarılı');

        return redirect()->route('admin.page.index');
    }

    public function edit($id)
    {
        //
        // ilgili makale yoksa findOrFail ile 404 sayfasına yönlendirme yapabiliyoruz
        $page = Page::findOrFail($id);
        return view('back.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'mimes:jpeg,png,jpg|max:500000'
        ]);

        /* Article modelinden yeni bir nesne turettim(db ye erisim yetkisi sagladım)*/
        $page = Page::findOrFail($id);
        $page->title = $request->title;
        $page->content = $request->contentt;
        $page->slug = str_slug($request->title);

        // secili resim var mi yok mu ?
        if($request->hasFile('image'))
        {
            /* getClientOriginalExtension => uzantıyı verir*/
            $imageName = str_slug($request->title).".".$request->image->getClientOriginalExtension();
            /* Resimin upload olacagi klasor ve isim*/
            $request->image->move(public_path('uploads'), $imageName);

            $page->image = $imageName;
        }
        $page->save();

        toastr()->success('Sayfa başarııyla güncellendi.', 'Başarılı');

        return redirect()->route('admin.page.index');
    }

    public function hardDelete($id)
    {
        $page = Page::find($id);
        if (File::exists($page->image))
        {
            // dosyadan resim silme
            File::delete(public_path($page->image));
        }
        $page->forceDelete();
        toastr()->warning('Sayfa silindi.', 'Başarılı');
        return redirect()->route('admin.page.index');
    }

    public function switch(Request $request)
    {
        $page = Page::findOrFail($request->id);
        $page->status = $request->statu == 'true' ? 1 : 0;
        $page->save();
    }

    public function orders(Request $request)
    {
        foreach ($request->get('page') as $key => $order)
        {
            Page::where('id',$order)->update(['order'=>$key]);
        }
    }
}
