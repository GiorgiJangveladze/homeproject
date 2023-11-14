<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ProductGroupItem;
use App\Models\UserProductGroup;
use App\Models\Product;

class ProductGroupItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('product_group_items')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $userProductGroup = UserProductGroup::first();
        $products = Product::whereIn('product_id', [2, 5])->get();
        if ($userProductGroup && $products->count() > 0) {
            foreach ($products as $product) {
                ProductGroupItem::create([
                    'group_id' => $userProductGroup->group_id,
                    'product_id' => $product->product_id,
                ]);
            }
        } else {
            echo "User product group or products not found.\n";
        }
    }
}
