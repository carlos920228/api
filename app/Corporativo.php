<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporativo extends Model
{
  protected $fillable = [
      'name',
      'email',
      'web',
      'tel_one',
      'tel_two',
  ];
}
