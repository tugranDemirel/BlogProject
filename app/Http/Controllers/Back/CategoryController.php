<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        return view('back.categories.index', compact('categories'));
    }

    public function create(Request $request)
    {
        $isExists = Category::where('slug',str_slug($request->category))->first();
        if ($isExists)
        {
            toastr()->error($request->category." adında bir kategori var.");
            return redirect()->back();
        }
        $category = new Category;
        $category->name = $request->category;
        $category->slug = str_slug($request->category);
        $category->save();
        toastr()->success('Kategori başarıyla oluşturuldu');
        return redirect()->back();

    }

    public function switch(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->statu == 'true' ? 1 : 0;
        $category->save();
    }

    public function getData(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }

    public function getDelete(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $count = $category->articleCount();
        $defaultCategory = Category::find(1);
        if($request->id == 1)
        {
            toastr()->info('Bu kategori sabit kategoridir. Silme işlemi gerçekleştirilemez.');
        }
        if ($count > 0)
        {
            Article::where('category_id', $category->id)->update([
                'category_id'=>1
            ]);
            toastr()->success('Silme işlemi başarıyla gerçekleştirildi.', 'Bu kategoriye ait '.$count.' makale '.$defaultCategory->name.' kategorisine taşındı');

        }
        else
        {
            toastr()->success('Silme işlemi başarıyla gerçekleştirildi.');
        }
        $category->delete();
        return redirect()->back();
    }

    public function update(Request $request)
    {
                                                                    // ilgili kategorimiz disinda demek whereNotIn
        $isSlug = Category::where('slug',str_slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName = Category::where('name',str_slug($request->category))->whereNotIn('id', [$request->id])->first();
        if ($isName or $isSlug)
        {
            toastr()->error($request->category." adında bir kategori var.");
            return redirect()->back();
        }
        $category = Category::find($request->id);
        $category->name = $request->category;
        $category->slug = $request->slug;
        $category->save();
        toastr()->success('Kategori başarıyla güncellendi.');
        return redirect()->back();
    }

}
