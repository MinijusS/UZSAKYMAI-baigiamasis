<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const ORDER_ACTIVE = 0;
    const ORDER_DONE = 1;
    const ORDER_CANCELLED = 2;

    protected $with = ['orderedItems'];

    public $fillable = ['address', 'phone', 'end_time', 'additional'];

    protected $attributes = [
        'status' => self::ORDER_ACTIVE,
        'address' => null,
        'phone' => null,
        'additional' => null
    ];

    public function orderedItems()
    {
        return $this->hasMany(OrderedItems::class);
    }
}
