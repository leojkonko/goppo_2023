<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Orchid\Support\Facades\Dashboard;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            'id' => 1,
            'active' => 1,
            'visible' => 0,
            'name' => 'Ellite Agência Digital',
            'username' => 'ellite1',
            'email' => 'dev2@ellitedigital.com.br',
            'email_verified_at' => now(),
            'password' => Hash::make("unused"), // Utilizamos API para senha real
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'permissions' => Dashboard::getAllowAllPermission(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->delete(1);
    }
};
