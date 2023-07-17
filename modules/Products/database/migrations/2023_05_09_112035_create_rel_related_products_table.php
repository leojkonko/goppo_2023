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
        Schema::create('rel_related_products', function (Blueprint $table) {
            $table->unsignedBigInteger('related_id');
            $table->unsignedBigInteger('product_id');

            $table->primary(['related_id', 'product_id'], 'rel_related_products_pk');

            $table->index('related_id', 'rel_relateds_index');
            $table->index('product_id', 'rel_products__index');

            $table->foreign('related_id', 'rel_relateds_foreign')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_id', 'rel_products__foreign')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rel_related_products');
    }
};
