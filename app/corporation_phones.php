<?php

namespace App;
use App\corporation;
use Illuminate\Database\Eloquent\Model;

class corporation_phones extends Model
{
  protected $fillable = [
      'number',
      'S_Tipo',
      'corporation_id',
  ];
  public function corporation(){
    return $this->belongsTo(corporation::class);
  }
}
