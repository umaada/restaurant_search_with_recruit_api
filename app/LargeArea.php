<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\RecruitApi;

use App\ServiceArea;
use App\MiddleArea;

class LargeArea extends Model
{
  protected $fillable = ['code', 'name', 'service_area_id'];

  protected $with = ['middleAreas'];

  public function serviceArea(){
    return $this->belongsTo(ServiceArea::class);
  }

  public function middleAreas(){
    return $this->hasMany(MiddleArea::class);
  }

  public function syncApiMaster(){
    $recruitApi = new RecruitApi;
    $largeAreas = $recruitApi->getLargeAreaMaster()->large_area;

    foreach($largeAreas as $largeArea){
      self::updateOrCreate(
        ['code' => $largeArea->code],
        [
          'name' => $largeArea->name,
          'service_area_id' => ServiceArea::where('code', $largeArea->service_area->code)->first()->id
        ]
      );
    }
  }
}
