<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

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
