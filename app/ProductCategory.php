<?php

namespace ProjectEcommerce;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name','image'];

    public function departament(){
        return $this->hasMany(ProductDepartament::class);
    }
}
