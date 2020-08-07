<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Tw_rol extends Model
{
  protected $fillable = [
      'S_Nombre',
      'S_MenuBgColor',
      'S_MenuBgImageUrl',
      'N_Activo',
  ];
  public function users(){
    return $this->hasMany(User::class);
  }
}
