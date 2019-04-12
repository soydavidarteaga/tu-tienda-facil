<?php

namespace ProjectEcommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "name",
        "description",
        "image",
        "code",
        "product_category_id"
    ];

    public function category(){
        return $this->hasMany(ProductCategory::class,'product_category_id');
    }
}
