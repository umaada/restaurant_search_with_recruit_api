<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RecruitApi;

class SearchController extends Controller
{

  public const SHOPS_PER_PAGE = 10;

  public function index()
  {
      $queries = $this->validateQueries();

      if(!$queries){
        $shops = [];
        $pagination = null;
        return view('shops.index', compact('shops', 'pagination'));
      }

      /**************************リクルートAPIにアクセス*************************************************************************************************************/

      $recruitApi = new RecruitApi;

      $result = $recruitApi->searchShops($queries['keyword'], $queries['large-area'], $queries['middle-area'], $queries['small-area'],
                                          $queries['genre'], $queries['budgets'], $queries['credit-cards'], $queries['start'], $queries['shops-per-page']);

     /**************************リクルートAPIにアクセス終了***********************************************************************************************************/


      $shops = $result->shop;

      $pagination = $this->paginate($result, $queries);

      return view('shops.index', compact('shops', 'pagination'));
  }

  private function validateQueries(){

    $queries = request()->query();

    $queries['keyword'] = array_key_exists('keyword', $queries) ? $queries['keyword'] : null;
    $queries['large-area'] = array_key_exists('large-area', $queries) ? $queries['large-area'] : null;
    $queries['middle-area'] = array_key_exists('middle-area', $queries) ? $queries['middle-area'] : null;
    $queries['small-area'] = array_key_exists('small-area', $queries) ? $queries['small-area'] : null;

    //最低でもキーワードかエリアを指定してもらう
    if($queries['keyword'] || $queries['large-area'] || $queries['middle-area'] || $queries['small-area']){

      if($queries['keyword']){
        //全角スペースを半角スペースに統一
        $queries['keyword'] = str_replace('　', ' ', $queries['keyword']);
      }

      //1ページあたりの店舗数の指定がなければクラス内のデフォルト値に設定
      $queries['genre'] = array_key_exists('genre', $queries) ? $queries['genre'] : null;
      $queries['budgets'] = array_key_exists('budgets', $queries) ? $queries['budgets'] : null;
      $queries['credit-cards'] = array_key_exists('credit-cards', $queries) ? $queries['credit-cards'] : null;
      //開始ページの指定がなければ1ページに設定
      $queries['shops-per-page'] = array_key_exists('shops_per_page', $queries) && $queries['shops-per-page'] ? $queries['shops-per-page'] : self::SHOPS_PER_PAGE;
      $queries['start'] = array_key_exists('page', $queries) && $queries['page'] ? $queries['shops-per-page'] * ($queries['page'] - 1) + 1 : 1;

      return $queries;


    }else {
      session()->flash('alert', 'キーワードまたはエリアを指定してください。');
      return null;
    }
  }

  private function paginate($result, $queries){

    $queriesWithoutPage = $this->trimPageQuery($queries);

    $pagination = [
      'all_results_count' => $result->results_available,
      'returned_results_count' => $result->results_returned,
      'results_start_num' => $result->results_start,
      'results_end_num' => $result->results_start + $result->results_returned - 1,
      'current_page' => $queries['page'],
      'last_page' => (int)ceil($result->results_available / $queries['shops-per-page']),
      'base_url' => url(request()->getPathInfo() . '?' . http_build_query($queriesWithoutPage)),
    ];

    $pagination['next_page_url'] = $pagination['current_page'] + 1 < $pagination['last_page'] ? $pagination['base_url'] . "&page=" . ($pagination['current_page'] + 1) : null;
    $pagination['prev_page_url'] = $pagination['current_page'] - 1 > 0                        ? $pagination['base_url'] . "&page=" . ($pagination['current_page'] - 1) : null;

    return $pagination;
  }

  private function trimPageQuery($queries){

    unset($queries['page']);

    return $queries;

  }



}
