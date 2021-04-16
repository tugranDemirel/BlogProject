<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;



    //kategorilerden ilgiki veriyi çekme
    function getCategory()
    {
        // hasOne bir kategoriye ait birden fazla yazı olabilir ama bir yazının bir kategorisi olabilri
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

}
