<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_group_items', function (Blueprint $table) {
            $table->id('item_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('product_id');            
            $table->foreign('group_id')->references('group_id')->on('user_product_groups');
            $table->foreign('product_id')->references('product_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_group_items');
    }
};
