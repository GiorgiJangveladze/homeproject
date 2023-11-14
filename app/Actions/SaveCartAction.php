<?php

namespace App\Actions;
use App\Models\Product;

class SaveCartAction
{
    public function run(Product $product): void
    {
        $productWithCart = $product->load([
            'carts' => function($q) {
                $q->where('user_id', auth()->id());
            }
        ]);
        if($productWithCart->carts->count() > 0) {
           $cart = $productWithCart->carts->first();
           $cart->quantity += 1;
           $cart->save();
        }else {
            $product->carts()->create([
                'user_id' => auth()->id(),
                'quantity' => 1
            ]);
        }
    }
}