<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Store;
use App\User;
use App\POheader;


class DashboardController extends Controller
{
    //
    public function index(){
        $store = Store::all();
        $user = User::all();
        $totalRevenue = Store::getTotalRevenue()[0]->amount;
        $totalSale = Store::getTotalSales();
        $arrayRevenue = Store::getTotalRevenueByMonth();
        return view('admin.dashboard')->with('stores',$store)->with('users',$user)->with('totalRevenue',$totalRevenue)->with('totalSales',$totalSale)->with('arrayRevenue',$arrayRevenue);
    }

}
