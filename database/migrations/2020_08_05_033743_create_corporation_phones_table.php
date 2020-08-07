<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporationPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporation_phones', function (Blueprint $table) {
          $table->increments('id');
          $table->bigInteger('number')->length(12);
          $table->string('S_Tipo');
          $table->integer('corporation_id')->unsigned();
          $table->timestamps();
          $table->softdeletes();
          $table->foreign('corporation_id')->references('id')->on('corporations')
          ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corporation_phones');
    }
}
