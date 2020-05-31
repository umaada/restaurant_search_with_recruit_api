<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RecruitApi {

  public $urls = [
    //マスタ関連のapi
    'budget' => 'http://webservice.recruit.co.jp/hotpepper/budget/v1/',
    'large_service_area' => 'http://webservice.recruit.co.jp/hotpepper/large_service_area/v1/',
    'service_area' => 'http://webservice.recruit.co.jp/hotpepper/service_area/v1/',
    'large_area' => 'http://webservice.recruit.co.jp/hotpepper/large_area/v1/',
    'middle_area' => 'http://webservice.recruit.co.jp/hotpepper/middle_area/v1/',
    'small_area' => 'http://webservice.recruit.co.jp/hotpepper/small_area/v1/',
    'genre' => 'http://webservice.recruit.co.jp/hotpepper/genre/v1/',
    'credit_card' => 'http://webservice.recruit.co.jp/hotpepper/credit_card/v1/',
    'special' => 'http://webservice.recruit.co.jp/hotpepper/special/v1/',
    'special_categoty' => 'http://webservice.recruit.co.jp/hotpepper/special_category/v1/',

    //検索api
    'gourmet_search' => 'http://webservice.recruit.co.jp/hotpepper/gourmet/v1/',
    'shopname_search' => 'http://webservice.recruit.co.jp/hotpepper/shop/v1/',

  ];

  static public function attatchKeyToUrl($url){
    return $url . '?key=' . config('api.recruit_api_key');
  }

  public function searchShops($keyword='', $largeArea='', $middleArea='', $smallArea='', $genre='', ?array $budgets=null, ?array $creditCards=null, $start=null, $shopsPerPage=10){

    if(!($keyword || $largeArea || $middleArea || $smallArea)){
      //TODO: エラー
    }
    $url = self::attatchKeyToUrl($this->urls['gourmet_search']) . '&format=json';
    $url .= $keyword ? "&keyword={$keyword}" : "";
    $url .= $largeArea ? "&large_area={$largeArea}" : "";
    $url .= $middleArea ? "&middle_area={$middleArea}" : "";
    $url .= $smallArea ? "&small_area={$smallArea}" : "";
    $url .= $genre ? "&genre={$genre}" : "";
    $url .= $start ? "&start={$start}" : "";
    $url .= "&count={$shopsPerPage}";

    if($budgets){
      foreach($budgets as $budget){
        $url .= "&budget={$budget}";
      }
    }

    if($creditCards){
      foreach($creditCards as $creditCard){
        $url .= "&credit_card={$creditCard}";
      }
    }

    $response = Http::get($url);
    //TODO: エラーチェック

    return json_decode($response->body())->results;
  }

  public function getBudgetMaster(){
    $response = Http::get(self::attatchKeyToUrl($this->urls['budget']) . '&format=json');
    //TODO: エラーチェック
    return json_decode($response->body())->results;
  }
  public function getLargeServiceAreaMaster(){
    $response = Http::get(self::attatchKeyToUrl($this->urls['large_service_area']) . '&format=json');
    //TODO: エラーチェック
    return json_decode($response->body())->results;
  }
  public function getServiceAreaMaster(){
    $response = Http::get(self::attatchKeyToUrl($this->urls['service_area']) . '&format=json');
    //TODO: エラーチェック
    return json_decode($response->body())->results;
  }
  public function getLargeAreaMaster(){
    $response = Http::get(self::attatchKeyToUrl($this->urls['large_area']) . '&format=json');
    //TODO: エラーチェック
    return json_decode($response->body())->results;
  }
  public function getMiddleAreaMaster(){
    $response = Http::get(self::attatchKeyToUrl($this->urls['middle_area']) . '&format=json');
    //TODO: エラーチェック
    return json_decode($response->body())->results;
  }
  public function getSmallAreaMaster(){
    $response = Http::get(self::attatchKeyToUrl($this->urls['small_area']) . '&format=json');
    //TODO: エラーチェック
    return json_decode($response->body())->results;
  }
  public function getGenreMaster(){
    $response = Http::get(self::attatchKeyToUrl($this->urls['genre']) . '&format=json');
    //TODO: エラーチェック
    return json_decode($response->body())->results;
  }
  public function getCreditCardMaster(){
    $response = Http::get(self::attatchKeyToUrl($this->urls['credit_card']) . '&format=json');
    //TODO: エラーチェック
    return json_decode($response->body())->results;
  }
  public function getSpecialMaster(){
    $response = Http::get(self::attatchKeyToUrl($this->urls['special']) . '&format=json');
    //TODO: エラーチェック
    return json_decode($response->body())->results;
  }
  public function getSpecialCategoryMaster(){
    $response = Http::get(self::attatchKeyToUrl($this->urls['special_categoty']) . '&format=json');
    //TODO: エラーチェック
    return json_decode($response->body())->results;
  }

}
