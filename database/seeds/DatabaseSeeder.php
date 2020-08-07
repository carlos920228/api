<?php

use Illuminate\Database\Seeder;
use App\corporation;
use App\corporation_phones;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      //DB::statement('SET FOREIGN_KEYS_CHECKS = 0');
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      corporation_phones::truncate();
      corporation_phones::flushEventListeners();
      corporation::truncate();
      corporation::flushEventListeners();
      $cantidad=10;
      $telefonos=30;
      factory(corporation::class,$cantidad)->create();
      factory(corporation_phones::class,$telefonos)->create();
    }
}
