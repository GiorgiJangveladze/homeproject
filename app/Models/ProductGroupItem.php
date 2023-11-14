<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGroupItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'product_id'
    ];

    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo(UserProductGroup::class, 'group_id', 'group_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

}
