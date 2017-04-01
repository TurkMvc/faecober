<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHaberlerTablosu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('haberler', function (Blueprint $table) {
            $table->increments('id');
            $table->string('baslik');
            $table->text('icerik');
            $table->string('slug');
            $table->integer('kullanici_id');
            $table->timestamps();
            $table->softDeletes(); //Geri dönüşüm kutusu gibi.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('haberler');
    }
}
