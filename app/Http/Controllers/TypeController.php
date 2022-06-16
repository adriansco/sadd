<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypeController extends Controller
{
    //types by product
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
