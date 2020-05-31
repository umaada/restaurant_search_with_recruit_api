<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\RecruitApi;

use App\MiddleArea;

class SmallArea extends Model
{
  protected $fillable = ['code', 'name', 'middle_area_id'];

  public function middleArea(){
    return $this->hasMany(MiddleArea::class);
  }

  public function syncApiMaster(){
    $recruitApi = new RecruitApi;
    $smallAreas = $recruitApi->getSmallAreaMaster()->small_area;

    foreach($smallAreas as $smallArea){
      self::updateOrCreate(
        ['code' => $smallArea->code],
        [
          'name' => $smallArea->name,
          'middle_area_id' => MiddleArea::where('code', $smallArea->middle_area->code)->first()->id
        ]
      );
    }
  }
}
