<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'user_id',
        'title',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function carts() {
        return $this->hasMany(Cart::class, 'product_id', 'product_id');
    }

    public function productGroupItem()
    {
        return $this->hasOne(ProductGroupItem::class, 'product_id', 'product_id');
    }
}
