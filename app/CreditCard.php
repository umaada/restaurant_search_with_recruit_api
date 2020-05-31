<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\RecruitApi;

class CreditCard extends Model
{
  protected $fillable = ['code', 'name'];

  public function syncApiMaster(){
    $recruitApi = new RecruitApi;
    $creditCards = $recruitApi->getCreditCardMaster()->credit_card;

    foreach($creditCards as $creditCard){
      self::updateOrCreate(
        ['code' => $creditCard->code],
        ['name' => $creditCard->name]
      );
    }
  }
}
