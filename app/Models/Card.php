<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['user_id', 'product_id'];

    // ✅ Un élément du panier est lié à un produit
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // ✅ Un élément du panier est lié à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
