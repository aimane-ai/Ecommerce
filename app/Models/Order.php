<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'name',
        'address',
        'telephone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Relation avec Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
