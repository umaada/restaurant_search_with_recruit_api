<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\RecruitApi;

use App\Special;

class SpecialCategory extends Model
{
  protected $fillable = ['code', 'name'];

  public function specials(){
    return $this->hasMany(Special::class);
  }

  public function syncApiMaster(){
    $recruitApi = new RecruitApi;
    $specialCategories = $recruitApi->getSpecialCategoryMaster()->special_category;

    foreach($specialCategories as $specialCategory){
      self::updateOrCreate(
        ['code' => $specialCategory->code],
        ['name' => $specialCategory->name]
      );
    }
  }
}
