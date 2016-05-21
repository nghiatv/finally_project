<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\POdetail;
use App\POheader;
use DB;
use App\Http\Requests;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('date-range')) {
            $req = $request->input('date-range');
            $req1 = explode(' - ', $req);
            $begin = trim($req1[0]);
            $end = trim($req1[1]);
            $listPO = DB::table('purchase_order_headers')->whereBetween('purchase_order_headers.order_date', [$begin, $end])->orderBy('purchase_order_headers.order_date', 'desc')->get();
            return view('bill.listbill')->with('list', $listPO)->with('range',$req);
        } else {
            $listPO = DB::table('purchase_order_headers')->orderBy('purchase_order_headers.order_date', 'desc')->get();
            return view('bill.listbill')->with('list', $listPO);
        }
        //


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
