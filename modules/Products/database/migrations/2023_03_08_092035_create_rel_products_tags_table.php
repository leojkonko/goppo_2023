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
        Schema::create('rel_products_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('product_tag_id');
            $table->unsignedBigInteger('product_id');

            $table->primary(['product_tag_id', 'product_id'], 'rel_products_tags_pk');

            $table->index('product_tag_id');
            $table->index('product_id');

            $table->foreign('product_tag_id')->references('id')->on('products_tags')->onDelete('cascade');
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
        Schema::dropIfExists('rel_products_tags');
    }
};
