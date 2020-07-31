<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sauce extends Model
{
    public $timestamps = false;

    protected $with = ['orderedItems'];

    public function orderedItems()
    {
        return $this->hasMany(OrderedItems::class);
    }
}
