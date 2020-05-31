<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\RecruitApi;

class Genre extends Model
{
  protected $fillable = ['code', 'name'];

  public function syncApiMaster(){
    $recruitApi = new RecruitApi;
    $genres = $recruitApi->getGenreMaster()->genre;

    foreach($genres as $genre){
      self::updateOrCreate(
        ['code' => $genre->code],
        ['name' => $genre->name]
      );
    }
  }
}
