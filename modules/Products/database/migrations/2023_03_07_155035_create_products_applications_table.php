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
        Schema::create('products_applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->integer('order')->default(9999);
            $table->boolean('active')->default(true);
        });
        Schema::create('products_applications_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug')->nullable();

            MigrationUtil::translationsColumns($table, 'products_applications', 'product_application_id');
            
            $table->string('title')->nullable();
            $table->string('text_1')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_applications_translations');
        Schema::dropIfExists('products_applications');
    }
};
