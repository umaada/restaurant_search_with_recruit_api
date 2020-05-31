<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Budget;

class BudgetController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index(){
       $budget = new Budget;
       $budget->syncApiMaster();
     }
}
