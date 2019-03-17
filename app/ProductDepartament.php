<?php

namespace ProjectEcommerce;

use Illuminate\Database\Eloquent\Model;

class ProductDepartament extends Model
{
    protected $fillable = ['name','image'];

    public function category(){
        return $this->belongsTo(ProductCategory::class);
    }
}
