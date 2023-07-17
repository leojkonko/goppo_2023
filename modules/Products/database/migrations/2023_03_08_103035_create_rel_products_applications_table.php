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
        Schema::create('rel_products_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('product_application_id');
            $table->unsignedBigInteger('product_id');

            $table->primary(['product_application_id', 'product_id'], 'rel_products_applications_pk');

            $table->index('product_application_id');
            $table->index('product_id');

            $table->foreign('product_application_id')->references('id')->on('products_applications')->onDelete('cascade');
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
        Schema::dropIfExists('rel_products_applications');
    }
};
