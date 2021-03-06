<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisings', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('own', ['doc', 'patient'])->index();
            $table->text('text')->nullable()->default(null);
            $table->text('text2')->nullable()->default(null);
            $table->text('text3')->nullable()->default(null);
            $table->text('text4')->nullable()->default(null);
            $table->text('text5')->nullable()->default(null);
            $table->enum('placement', ['footer', 'sidebar', 'sidebar_2', 'main_1', 'main_2', 'main_3']);

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
        Schema::dropIfExists('advertisings');
    }
}
