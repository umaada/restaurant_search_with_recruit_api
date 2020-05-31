<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\RecruitApi;

use App\ServiceArea;

class LargeServiceArea extends Model
{
  protected $fillable = ['code', 'name'];

  public function serviceAreas(){
    return $this->hasMany(ServiceArea::class);
  }

  public function syncApiMaster(){
    $recruitApi = new RecruitApi;
    $largeServiceAreas = $recruitApi->getLargeServiceAreaMaster()->large_service_area;

    foreach($largeServiceAreas as $largeServiceArea){
      self::updateOrCreate(
        ['code' => $largeServiceArea->code],
        ['name' => $largeServiceArea->name]
      );
    }
  }
}
