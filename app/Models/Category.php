<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // kategoriye ait kac tane yazi var
    function articleCount()
    {
//                                  baglanilacak model,         baglanilacak sutun,     baglanilacak id
        return $this->hasMany('App\Models\Article', 'category_id', 'id')->count();
    }
}
