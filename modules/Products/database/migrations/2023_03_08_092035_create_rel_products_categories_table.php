<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Ellite\MigrationUtil;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_products_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('product_id');

            $table->primary(['product_category_id', 'product_id'], 'rel_products_categories_pk');

            $table->index('product_category_id');
            $table->index('product_id');

            $table->foreign('product_category_id')->references('id')->on('products_categories')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rel_products_categories');
    }
};
