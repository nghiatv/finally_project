<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('product.listproduct')->with('products',$products);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
//
        if ($request->input('date-range')) {
          if($request->input('date-range') == "all"){
//              return var_dump($request->input('date-range'));
              $list = DB::table('purchase_order_headers')
                  ->join('purchase_order_details','purchase_order_headers.id','=','purchase_order_details.po_id')
                  ->join('products','purchase_order_details.pid','=','products.id')
                  ->where('products.id','=',$id)
                  ->orderBy('purchase_order_headers.order_date', 'desc')
                  ->get();
//              dd($listPO);
              $end = date(  "Y-m-d",strtotime($list[0]->order_date));
              $begin = date("Y-m-d",strtotime($list[(count($list)-1)]->order_date));
              $req = $req = $begin." - ".$end;
//              dd($req);
              $totalQuantity = 0;
              $totalAmount = 0;
              foreach($list as $item){
                  $totalQuantity+=$item->quantity;
                  $totalAmount+=$item->amount;
              }
//              dd($list);
              return view('product.productdetail')->with('list', $list)->with('id',$id)->with('range',$req)
                  ->with('totalquantity',$totalQuantity)->with('totalamount',$totalAmount);
          }else{
              $req = $request->input('date-range');
              $req1 = explode(' - ', $req);
              $begin = trim($req1[0]);
              $end = trim($req1[1]);
//           dd( var_dump($begin));
              $listPO = DB::table('purchase_order_headers')
                  ->join('purchase_order_details','purchase_order_headers.id','=','purchase_order_details.po_id')
                  ->join('products','purchase_order_details.pid','=','products.id')
                  ->whereBetween('purchase_order_headers.order_date', [$begin, $end])
                  ->where('products.id','=',$id)
                  ->orderBy('purchase_order_headers.order_date', 'desc')
                  ->get();
//            dd($listPO);
              $totalQuantity = 0;
              $totalAmount = 0;
              foreach($listPO as $item){
                  $totalQuantity+=$item->quantity;
                  $totalAmount+=$item->amount;
              }

              return view('product.productdetail')->with('list', $listPO)->with('id',$id)->with('range',$req)
                  ->with('totalquantity',$totalQuantity)->with('totalamount',$totalAmount);

//            return view('product.productdetail')->with('list', $listPO)->with('range',$req)->with('id',$id);
          }

        } else {
            $begin = date("Y-m-d",time() - 30*86400);
            $end    = date("Y-m-d", time() + 86400 );
            $req = $begin." - ".$end;
            $listPO = DB::table('purchase_order_headers')
                ->join('purchase_order_details','purchase_order_headers.id','=','purchase_order_details.po_id')
                ->join('products','purchase_order_details.pid','=','products.id')
                ->whereBetween('purchase_order_headers.order_date', [$begin, $end])
                ->where('products.id','=',$id)
                ->orderBy('purchase_order_headers.order_date', 'desc')
                ->get();
            $totalQuantity = 0;
            $totalAmount = 0;
            foreach($listPO as $item){
                $totalQuantity+=$item->quantity;
                $totalAmount+=$item->amount;
            }

            return view('product.productdetail')->with('list', $listPO)->with('id',$id)->with('range',$req)
                ->with('totalquantity',$totalQuantity)->with('totalamount',$totalAmount);
        }
    }
    public function getAll($id){
        $listPO = DB::table('purchase_order_headers')
            ->join('purchase_order_details','purchase_order_headers.id','=','purchase_order_details.po_id')
            ->join('products','purchase_order_details.pid','=','products.id')
            ->where('products.id','=',$id)
            ->orderBy('purchase_order_headers.order_date', 'desc')
//                ->groupBy('products.id')
            ->get();
            $end = date("Y-m-d",strtotime(' -1 day',$listPO[0]->order_date));
            $begin = date("Y-m-d",strtotime( '+1 day',array_pop($listPO)->order_date));
            $req = $req = $begin." - ".$end;
        $totalQuantity = 0;
        $totalAmount = 0;
            foreach($listPO as $item){
                $totalQuantity+=$item->quantity;
                $totalAmount+=$item->amount;
            }
            return view('product.productdetail')->with('list', $listPO)->with('id',$id)->with('range',$req)
                ->with('totalquantity',$totalQuantity)->with('totalamount',$totalAmount);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
