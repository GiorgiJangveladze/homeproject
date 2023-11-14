<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('products')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $user = User::where('name', 'User1')->first();

        if ($user) {
            // Seed products associated with the user
            $products = [
                ['user_id' => $user->id, 'title' => 'Product 1', 'price' => 10.00],
                ['user_id' => $user->id, 'title' => 'Product 2', 'price' => 15.00],
                ['user_id' => $user->id, 'title' => 'Product 3', 'price' => 8.00],
                ['user_id' => $user->id, 'title' => 'Product 4', 'price' => 7.00],
                ['user_id' => $user->id, 'title' => 'Product 5', 'price' => 20.00],
            ];

            DB::table('products')->insert($products);
        } else {
            echo "User not found.\n";
        }
    }
}
