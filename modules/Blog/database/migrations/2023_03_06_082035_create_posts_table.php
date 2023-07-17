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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->integer('order')->default(9999);
            $table->boolean('active')->default(true);

            $table->date('post_date')->nullable();
            $table->date('publish_date')->nullable();
            $table->time('publish_time')->nullable();
        });
        Schema::create('posts_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            MigrationUtil::translationsColumns($table, 'posts', 'post_id');
            
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('short_title')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->mediumtext('text')->nullable();
            $table->mediumtext('short_text')->nullable();
            $table->string('video')->nullable();
            $table->integer('hits')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_translations');
        Schema::dropIfExists('posts');
    }
};
