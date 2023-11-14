<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UserProductGroup;
use App\Models\User;

class UserProductGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('user_product_groups')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $user = User::where('name', 'User1')->first();

        if ($user) {
            UserProductGroup::create([
                'user_id' => $user->id,
                'discount' => 15,
            ]);
        } else {
            echo "User not found.\n";
        }
    }
}
