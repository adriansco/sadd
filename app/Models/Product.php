<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    //product_variant
    public function variants()
    {
        return $this->hasMany('App\Models\ProductVariant');
    }
    //type
    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }
}
