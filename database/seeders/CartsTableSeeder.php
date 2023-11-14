<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('carts')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $user = User::where('name', 'User2')->first();
        $products = Product::whereIn('product_id', [2, 5, 1])->get();

        if ($user && $products->count() > 0) {
            foreach ($products as $product) {
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $product->product_id,
                    'quantity' => 3
                ]);
            }
        } else {
            echo "User or products not found.\n";
        }
    }
}
