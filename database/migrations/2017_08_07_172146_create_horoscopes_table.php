<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoroscopesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horoscopes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('aries')->nullable()->default(null);
            $table->text('taurus')->nullable()->default(null);
            $table->text('gemini')->nullable()->default(null);
            $table->text('cancer')->nullable()->default(null);
            $table->text('leo')->nullable()->default(null);
            $table->text('virgo')->nullable()->default(null);
            $table->text('libra')->nullable()->default(null);
            $table->text('scorpio')->nullable()->default(null);
            $table->text('sagittarius')->nullable()->default(null);
            $table->text('capricorn')->nullable()->default(null);
            $table->text('aquarius')->nullable()->default(null);
            $table->text('pisces')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horoscopes');
    }
}
