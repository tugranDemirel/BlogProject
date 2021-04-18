<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config;
class ConfigController extends Controller
{
    //
    public function index()
    {
        $config = Config::find(1);
        return view('back.config.index', compact('config'));
    }

    public function update(Request $request)
    {
        $config = Config::find(1);
        $config->title = $request->title;
        $config->active = $request->active;
        $config->facebook = $request->facebook;
        $config->twitter = $request->twitter;
        $config->linkedin = $request->linkedin;
        $config->github = $request->github;
        $config->youtube = $request->youtube;
        $config->instagram = $request->instagram;

        if($request->hasFile('logo'))
        {
            /* getClientOriginalExtension => uzantıyı verir*/
            $logo = str_slug($request->title)."-logo.".$request->logo->getClientOriginalExtension();
            /* Resimin upload olacagi klasor ve isim*/
            $request->logo->move(public_path('uploads'), $logo);

            $config->logo = $logo;
        }
        if($request->hasFile('favicon'))
        {
            /* getClientOriginalExtension => uzantıyı verir*/
            $favicon = str_slug($request->title)."-favicon.".$request->favicon->getClientOriginalExtension();
            /* Resimin upload olacagi klasor ve isim*/
            $request->favicon->move(public_path('uploads'), $favicon);

            $config->favicon = $favicon;
        }

        $config->save();

        toastr()->success('Güncelleme başarıyla gerçekleştirildi.', 'Başarılı');
        return redirect()->back();
    }
}
