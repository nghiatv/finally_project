<?php

namespace App\Http\Controllers;

use App\POdetail;
use App\POheader;
use App\Store;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Role;
use App\User;
use App\Permission;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AnalyticController extends Controller
{
    //


    public function getProducts($id)
    {
        $user = Auth::guard()->user();
        if ($user->can('view')) {
            $store = Store::findOrFail($id);
            $products = Product::where('store_id', '=', $id)->orderBy('product_name', 'desc')->get();
            return view('store.products', ['products' => $products, 'page_name' => $store->store_name]);
//            return response()->json($allProduct);
        } else {
            $error = 'Không có quyền';
            return response()->json($error);
        }
//     return response()->json(Auth::guard()->user());
    }

    public function listPO($id)
    {
        $user = Auth::guard()->user();
        if ($user->can('view')) {
            $store = Store::findOrFail($id);
            $pos = POheader::where('store_id', '=', $id)->orderBy('purchase_order_name', 'desc')->get();
            return view('store.poheaders', [
                'poheaders' => $pos,
                'page_name' => $store->store_name
            ]);
        } else {
            $error = 'Không có quyền';
            return response()->json($error);
        }
    }

    public function getInvoice($id)
    {
//        echo 1;
        $user = Auth::guard()->user();
        if ($user->can('view')) {
            $poheader = POheader::findOrFail($id);
            if ($poheader) {
                $podetails = POdetail::where('po_id', '=', $id)->get();
                $store = Store::findOrFail($poheader->store_id);

                return view('store.invoice', ['poheader' => $poheader, 'podetails' => $podetails, 'store' => $store]);

            } else {
                return response()->json('nghia');
                return view('errors.404');
            }

        } else {
            return Redirect::to('admin/store');
        }
    }
}
