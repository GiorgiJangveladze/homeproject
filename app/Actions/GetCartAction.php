<?php

namespace App\Actions;
use App\Models\ProductGroupItem;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\DB;

class GetCartAction
{
    public function run(): array
    {
        $userId = auth()->id();
        $groups = ProductGroupItem::get();
        $carts = DB::table('carts as c')
            ->select('c.product_id', 'c.quantity', 'p.price', 'gpi.group_id', 'upg.discount')
            ->join('products as p', 'p.product_id', '=', 'c.product_id')
            ->leftJoin('product_group_items as gpi', 'gpi.product_id', '=', 'p.product_id')
            ->leftJoin('user_product_groups as upg', 'upg.group_id', '=', 'gpi.group_id')
            ->where('c.user_id', $userId)
            ->get();

        return [
            'products' => CartResource::collection($carts) ?? [],
            'discount' => $this->calculateDiscount($carts, $groups) ?? 0
        ];
    }

    private function calculateDiscount($carts, $groups): float {
        $finalDiscount = 0;
        foreach($carts->groupBy('group_id') as $key => $cart) {
            $group = $groups->where('group_id', $key);
            $groupCount = $group->count();
            $productIds = $cart->pluck('product_id');
            $inCartCount = $group->whereIn('product_id', $productIds)->count();
            if($groupCount === $inCartCount) {
                $minQ = $cart->min('quantity');
                foreach($cart as $product) {
                    $discountPriceSum = $minQ * $product->price;
                    $finalDiscount += $discountPriceSum * ($product->discount / 100);
                }
            }
        }

        return $finalDiscount;
    }
}