<?php

namespace App\Http\Controllers;

use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class StoreController extends Controller
{


    public function index()
    {
        $stores = Store::all();
        return view('admin.liststore')->with('stores', $stores);
    }

    public function create()
    {
        return view('admin.create_store');
    }

    public function store(Request $request)
    {
//        return response()->json($request);
        $validator = Validator::make($request->all(), [
            'store_name' => 'required',
            'store_email' => 'required|email|unique:stores',
            'store_phone' => 'required|numeric',
            'store_description' => 'max:255',
            'control_code' => 'required|unique:stores'
        ]);
        if ($validator->fails()) {
            return Redirect::to('admin/store/create')->withErrors($validator->errors())->withInput();
        } else {
            $store = Store::where('store_email', '=', $request->input('store_email'))->first();
            if (!$store) {
                try {
                    Store::create([
                        'store_name' => $request->input('store_name'),
                        'store_phone' => $request->input('store_phone'),
                        'store_email' => $request->input('store_email'),
                        'store_description' => $request->input('store_description'),
                        'control_code' => $request->input('control_code')
                    ]);
                } catch (\Exception $e) {
                    return Redirect::to('admin/store/create')->with('errors', $e->getMessage())->withInput();
                }

                return Redirect::to('admin/store/');

            } else {
                return Redirect::to('admin/store/create')->with('errors', 'User đã tồn tại');
            }
        }
    }

    public function show($id)
    {
        $store = Store::findOrFail($id);
        $orders = Store::getLatestOrders($id, 10);
        $bestseller = Store::getBestSelling($id, 30);
        $revenue = Store::getRevenue($id);
        $neworders = Store::getNewOrders($id);
        $revenueLastMonth = Store::getRevenueInLastMonth($id);
        return view('admin.single_store')->with('revenueLastMonth', $revenueLastMonth)->with('store', $store)->with('orders', $orders)->with('bestseller', $bestseller)->with('revenue', $revenue)->with('neworders', $neworders);
    }

    public function edit($id)
    {
        $store = Store::findOrFail($id);
        if ($store) {
            return view('admin.edit_store')->with('store', $store);
        }
        return response()->json('Not Found', 404);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'store_name' => 'required',
            'store_email' => 'required|email', //chua toi uu code o day
            'store_phone' => 'required|numeric',
            'store_description' => 'max:255',
            'control_code' => 'required'
        ]);
        if ($validator->fails()) {
            return Redirect::to('admin/store/' . $id . '/edit')->withErrors($validator->errors())->withInput();
        } else {
            $store = Store::findOrFail($id);
            if ($store) {
                try {
                    DB::table('stores')->where('id', $id)->update([
                        'store_name' => $request->input('store_name'),
                        'store_email' => $request->input('store_email'),
                        'store_phone' => $request->input('store_phone'),
                        'store_description' => $request->input('store_description'),
                        'control_code' => $request->input('control_code'),

                    ]);
                } catch (\Exception $e) {
                    return Redirect::to('admin/store/' . $id . '/edit')->with('errors', $e->getMessage());
                }

                return Redirect::to('admin/store/' . $id . '/edit')->with('messages', "Thay đổi thành công")->with('store', $store);

            } else {
                return Redirect::to('admin/store/' . $id . '/edit')->with('errors', 'User ko tồn tại');
            }
        }
    }

    public function destroy($id)
    {
        $store = Store::findOrFail($id);
//        $store->users()->sync([]);
//        dd($store);
        $store->forceDelete();
        return Redirect::to('admin/store');
    }
}
