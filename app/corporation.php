<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\corporation_phones;
use App\User;
class corporation extends Model
{
  //use softDeletes;
  //protected $dates=['deleted_at'];
  protected $fillable = [
      'name',
      'email',
      'web',
  ];
  public function telephones(){
    return $this->hasMany(corporation_phones::class);
  }
  public function users(){
    return $this->hasMany(User::class);
  }
}
