<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\RecruitApi;

class Budget extends Model
{
    protected $fillable = ['code', 'name'];

    public function syncApiMaster(){
      $recruitApi = new RecruitApi;
      $budgets = $recruitApi->getBudgetMaster()->budget;

      foreach($budgets as $budget){
        self::updateOrCreate(
          ['code' => $budget->code],
          ['name' => $budget->name]
        );
      }
    }
}
