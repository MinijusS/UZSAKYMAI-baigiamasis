<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    public $fillable = ['name', 'description', 'price_big', 'price_small', 'category_id', 'photo', 'ppk'];
}
