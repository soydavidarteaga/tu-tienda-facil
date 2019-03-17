<?php

namespace ProjectEcommerce;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['company_name','email','phone','country','state','city','address','logo','logo_web','favicon'];
}
