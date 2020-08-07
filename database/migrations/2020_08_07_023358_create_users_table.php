<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     //'name', 'email', 'password','N_Activo','tw_rols_id','corporation_id'
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('email')->unique();
          $table->dateTime('D_UltimaSesion')->nullable();
          $table->rememberToken();
          $table->string('password');
          $table->integer('N_Activo')->default(1);
          $table->integer('tw_rol_id')->unsigned();
          $table->integer('corporation_id')->unsigned();
          $table->timestamps();
          $table->softdeletes();
          $table->foreign('tw_rol_id')->references('id')->on('tw_rols')
          ->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
