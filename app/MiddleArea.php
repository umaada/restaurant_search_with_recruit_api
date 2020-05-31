<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\RecruitApi;

use App\LargeArea;
use App\SmallArea;

class MiddleArea extends Model
{
  protected $fillable = ['code', 'name', 'large_area_id'];

  protected $with = ['smallAreas'];

  public function largeArea(){
    return $this->belongsTo(LargeArea::class);
  }

  public function smallAreas(){
    return $this->hasMany(SmallArea::class);
  }

  public function syncApiMaster(){
    $recruitApi = new RecruitApi;
    $middleAreas = $recruitApi->getMiddleAreaMaster()->middle_area;

    foreach($middleAreas as $middleArea){
      self::updateOrCreate(
        ['code' => $middleArea->code],
        [
          'name' => $middleArea->name,
          'large_area_id' => LargeArea::where('code', $middleArea->large_area->code)->first()->id
        ]
      );
    }
  }
}
