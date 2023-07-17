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
        Schema::create('our_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->integer('order')->default(9999);
            $table->boolean('active')->default(true);
        });
        Schema::create('our_histories_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            MigrationUtil::translationsColumns($table, 'our_histories', 'our_history_id');
            
            $table->text('title_1')->nullable();
            $table->text('title_2')->nullable();
            $table->text('title_3')->nullable();
            $table->text('title_4')->nullable();

            $table->text('text_1')->nullable();
            $table->text('text_2')->nullable();
            $table->text('text_3')->nullable();
            $table->text('text_4')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('our_histories_translations');
        Schema::dropIfExists('our_histories');
    }
};
