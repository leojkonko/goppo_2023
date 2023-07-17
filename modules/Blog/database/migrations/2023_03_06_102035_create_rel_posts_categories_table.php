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
        Schema::create('rel_posts_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('post_category_id');
            $table->unsignedBigInteger('post_id');

            $table->primary(['post_category_id', 'post_id'], 'rel_posts_categories_pk');

            $table->index('post_category_id');
            $table->index('post_id');

            $table->foreign('post_category_id')->references('id')->on('posts_categories')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rel_posts_categories');
    }
};
