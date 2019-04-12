<?php

namespace ProjectEcommerce;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name','image','product_departament_id'];

    public function departament(){
        return $this->hasMany(ProductDepartament::class,'product_departament_id');
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
