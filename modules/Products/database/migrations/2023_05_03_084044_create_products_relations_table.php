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
        Schema::create('products_relations', function (Blueprint $table) {
            $table->id();

            $columns = [
                'product_id' => 'products',
                'product_application_id' => 'products_applications',
                'product_category_id' => 'products_categories',
            ];

            foreach ($columns as $column => $table_name) {
                $table->unsignedBigInteger($column)->nullable();
                $table->index($column);
                $table->foreign($column)->references('id')->on($table_name)->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_relations');
    }
};
