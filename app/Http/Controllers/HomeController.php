<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use App\Services\RecruitApi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $search = request()->query('search');

        if($search){

          //全角・半角スペースで区切る
          $search = str_replace('　', ' ', $search);

          $recruitApi = new RecruitApi;

          $shops = $recruitApi->searchShops($search)->shop;

          return view('home', compact('shops'));
        }

        return view('home');
    }
}
