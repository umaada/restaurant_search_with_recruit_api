<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\RecruitApi;

use App\LargeServiceArea;
use App\LargeArea;

class ServiceArea extends Model
{
  protected $fillable = ['code', 'name', 'large_service_area_id'];

  public function largeServiceArea(){
    return $this->belongsTo(LargeServiceArea::class);
  }
  
  public function largeAreas(){
    return $this->hasMany(LargeArea::class);
  }

  public function syncApiMaster(){
    $recruitApi = new RecruitApi;
    $serviceAreas = $recruitApi->getServiceAreaMaster()->service_area;

    foreach($serviceAreas as $serviceArea){
      self::updateOrCreate(
        ['code' => $serviceArea->code],
        [
          'name' => $serviceArea->name,
          'large_service_area_id' => LargeServiceArea::where('code', $serviceArea->large_service_area->code)->first()->id
        ]
      );
    }
  }
}
