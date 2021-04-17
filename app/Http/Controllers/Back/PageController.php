<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    //
    public function index()
    {
        $pages = Page::all();
        return view('back.pages.index', compact('pages'));
    }

    public function switch(Request $request)
    {
        $page = Page::findOrFail($request->id);
        $page->status = $request->statu == 'true' ? 1 : 0;
        $page->save();
    }
}
