<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\RecruitApi;

use App\SpecialCategory;

class Special extends Model
{
  protected $fillable = ['code', 'name', 'special_category_id'];

  public function specialCategory(){
    return $this->belongsTo(SpecialCategory::class);
  }

  public function syncApiMaster(){
    $recruitApi = new RecruitApi;
    $specials = $recruitApi->getSpecialMaster()->special;

    foreach($specials as $special){
      self::updateOrCreate(
        ['code' => $special->code],
        [
          'name' => $special->name,
          'special_category_id' => SpecialCategory::where('code', $special->special_category->code)->first()->id
        ]
      );
    }
  }
}
