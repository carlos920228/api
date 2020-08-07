<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwRolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tw_rols', function (Blueprint $table) {
            $table->increments('id');
            $table->string('S_Nombre',45);
            $table->string('S_MenuBgColor',45);
            $table->string('S_MenuBgImageUrl',200);
            $table->boolean('N_Activo');
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tw_rols');
    }
}
