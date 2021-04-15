<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Homepage extends Controller
{
    //anasyfamizi calistiran controller
    public function index()
    {
        return view('front.homepage');
    }
}
