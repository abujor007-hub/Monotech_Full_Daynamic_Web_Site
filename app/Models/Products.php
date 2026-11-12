<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'title',
        'category',
        'price',
        'discount_price',
        'quantity',
        'status',
        'description',
        'product_image',

    ];

        public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

}
