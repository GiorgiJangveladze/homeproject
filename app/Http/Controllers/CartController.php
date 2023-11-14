<?php

namespace App\Http\Controllers;

use App\Actions\SaveCartAction;
use App\Actions\GetCartAction;
use App\Traits\ResponseHelper;
use App\Http\Requests\CartRequest;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    use ResponseHelper;

    private $saveCartAction, $getCartAction;

    public function __construct(SaveCartAction $saveCartAction, GetCartAction $getCartAction)
    {
        $this->saveCartAction = $saveCartAction;
        $this->getCartAction = $getCartAction;
    }

    public function addProductInCart(Product $product)
    {   
        return $this->safeResponse(function() use ($product) {
            $this->saveCartAction->run($product);
            return [ 'status' => true, 'message' => 'Product was saved successfully' ];
        });
    }

    public function removeProductFromCart(Product $product)
    {   
        return $this->safeResponse(function() use ($product) {
            $productWithCart = $product->load([
                'carts' => function($q) {
                    $q->where('user_id', auth()->id());
                }
            ]);

            if(!empty($productWithCart->carts)) {
                $productWithCart->carts->first()->delete();
            }
            return [ 'status' => true, 'message' => 'Product was deleted successfully' ];
        });
    }

    public function setCartProductQuantity(CartRequest $request)
    {
        return $this->safeResponse(function() use ($request) {
            $userId = auth()->id();
            $validated = $request->validated();
            $cart = Cart::where([
                ['product_id', $validated['product_id']],
                ['user_id', $userId]
            ])->first();

            if($cart && !empty($validated['quantity'])) {
                $cart->update(['quantity' => $validated['quantity']]);
                return [ 'status' => true, 'message' => 'Product quantity was updated successfully' ];
            }else {
                return [ 'status' => false, 'message' => 'Something wrong' ];
            }
        });
    }

    public function getUserCart()
    {
        return $this->safeResponse(function() {
            return $this->getCartAction->run();
        });
    }
}
