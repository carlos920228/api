<?php

use Illuminate\Database\Seeder;
use App\corporation;
use App\corporation_phones;
use App\User;
use App\Tw_rol;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
      //DB::statement('SET FOREIGN_KEYS_CHECKS = 0');
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      corporation_phones::truncate();
      corporation_phones::flushEventListeners();
      corporation::truncate();
      corporation::flushEventListeners();
      Tw_rol::truncate();
      Tw_rol::flushEventListeners();
      User::truncate();
      User::flushEventListeners();
      corporation::flushEventListeners();
      $cantidad=10;
      $telefonos=30;
      $usuarios=5;
      $roles=4;
      factory(corporation::class,$cantidad)->create();
      factory(corporation_phones::class,$telefonos)->create();
      factory(Tw_rol::class,$roles)->create();
      factory(User::class,$usuarios)->create();
    }
}
