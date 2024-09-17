<?php

use App\Models\Category;
use App\Models\SubCategory;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('manufacturer');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->decimal('discount', 4, 2)->default(0.00);
            $table->timestamp('discount_valid_until')->nullable();
            $table->boolean('stock_status');
            $table->unsignedBigInteger('productable_id');
            $table->string('productable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
