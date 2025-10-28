<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = [
        'name',
        'description',
        'prix',
        'quantite',
        'image',
        'category',
    ];

    public function comment(){
        return $this->hasMany(Comment::class);
    }
public function likes()
{
    return $this->hasMany(Like::class);
}

}
