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
        Schema::create('product_inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Product::class)->nullable();
            $table->string('customer_name');
            $table->string('customer_id');
            $table->string('customer_id_number');
            $table->integer('rented_quantity');
            $table->integer('return_quantity')->nullable();
            $table->integer('damage_quantity')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_inventories');
    }
};
