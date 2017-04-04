<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEksikBilgiler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) { // var olan tabloya veri ekleme
            $table->boolean('isadmin')->after('password')->default('0');
            $table->string('surname')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) { // var olan tabloya veri ekleme
            $table->dropColumn('isadmin');
            $table->dropColumn('surname');
        });
    }
}
