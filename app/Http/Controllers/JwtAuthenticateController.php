<?php
//namespace App\Http\Controllers;
//
//use App\Permission;
//use App\Role;
//use Log;
//use Illuminate\Http\Request;
//
//use App\Http\Controllers\Controller;
//use JWTAuth;
//use Tymon\JWTAuth\Exceptions\JWTException;
//
//
//use App\Http\Requests;
//
//use App\User;
//use Illuminate\Support\Facades\Hash;
//

namespace App\Http\Controllers;

use App\Permission;
use App\POheader;
use App\Role;
use App\User;
use App\Store;
use App\Shipment;
//use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
//use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions;
use Illuminate\Support\Facades\Hash;
use Log;


class JwtAuthenticateController extends Controller
{
//    public  function __construct(){
//        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
//    }


    public function authenticate(Request $request)
    {
//        return 1;
        $credentials = $request->only('email', 'password');
        $id = User::where('email','=',$credentials['email'])->get();
        $id = $id[0]->store_id;
        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json([compact('token'),compact('id')]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthenticateUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['Không tồn tại người dùng trong hệ thống'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    public function sendPO(Request $request)
    {
//        dd($this->verifyPO($request));
//        return response()->json( $this->verifyPO($request));
        if ($this->verifyPO($request) !== true ) {
            return response()->json(
                $this->verifyPO($request)
            );
        } else {

            $data = $request->input('data');
            $included = $request->input('included');
            $ship_id = null;
            $customer_id = null;
            // insert new attribute to database
            foreach ($included as $item) {

                //insert Shipmethod if not exist
                if ($item['type'] == 'ship_method') {
                    $attributes = $item['attributes'];
                    $name = str_slug($attributes['name'], '-');
                    $display_name = $attributes['name'];
//                    var_dump($attributes);
                    $description = $attributes['description'];
                    $v = DB::table('shipments')->where('name', $name)->where('store_id', $request->input('sender_id'))->first();
                    if (!$v) {
                        try {
                            DB::table('shipments')->insert([
                                'store_id' => $request->input('sender_id'),
                                'name' => $name,
                                'display_name' => $display_name,
                                'description' => $description,
                                'created_at' => date('Y-m-d H:i:s', time()),
                                'updated_at' => date('Y-m-d H:i:s', time())
                            ]);
                        } catch (\Exception $e) {
                            return response()->json($e->getMessage());
                        }
                    }
                    $ship_id = DB::table('shipments')->where('name', $name)->where('store_id', $request->input('sender_id'))->first()->id;
//                    return $name.' '.$display_name.' '.$description;
                }
                //insert Product if not exist
                if ($item['type'] == 'product') {
                    $attributes = $item['attributes'];
                    $product_name = $attributes['name'];
                    if ($attributes['code']) {
                        $product_code = $attributes['code'];
                    } else {
                        $product_code = str_slug($attributes['name'], "-");
                    }
                    $size = $attributes['size'];
                    $style = $attributes['style'];
                    $v = DB::table('products')->where('product_code', $product_code)->where('store_id', $request->input('sender_id'))->first();
                    if (!$v) {
                        try {
                            DB::table('products')->insert([
                                'store_id' => $request->input('sender_id'),
                                'product_name' => $product_name,
                                'product_code' => $product_code,
                                'size' => $size,
                                'style' => $style,
                                'created_at' => \Carbon\Carbon::now(),
                                'updated_at' => \Carbon\Carbon::now()
                            ]);
                        } catch (\Exception $e) {
                            return response()->json($e->getMessage());
                        }
                    }

                }
                //insert Customer if not exist

                if ($item['type'] == "customer") {
                    $attributes = $item['attributes'];
                    $name = $attributes['name'];
                    $email = $attributes['email'];
                    $address = $attributes['address'];
                    $phone = $attributes['phone'];
                    $description = $attributes['description'];
                    $v = DB::table('customers')->where('phone', $phone)->where('store_id', $request->input('sender_id'))->first();
                    if (!$v) {
                        try {
                            DB::table('customers')->insert([
                                'store_id' => $request->input('sender_id'),
                                'name' => $name,
                                'email' => $email,
                                'address' => $address,
                                'phone' => $phone,
                                'description' => $description,
                                'created_at' => \Carbon\Carbon::now(),
                                'updated_at' => \Carbon\Carbon::now()
                            ]);
                        } catch (\Exception $e) {
                            return response()->json($e->getMessage());
                        }
                    }
                    $customer_id = DB::table('customers')->where('phone', $phone)->where('store_id', $request->input('sender_id'))->first()->id;
//                    dd($customer_id);
                }

            }

            //insert PO header
            try {
                DB::table('purchase_order_headers')->insert([
                    'store_id' => $request->input('sender_id'),
                    'purchase_order_name' => $data[0]['purchase_order_name'],
                    'control_number' => $request->input('control_transaction'),
                    'seller' => $data[0]['properties']['seller'],
                    'ship_id' => $ship_id,
                    'order_date' => $data[0]['order_date'],
                    'ship_cost' => $data[0]['properties']['ship_cost'],
                    'discount' => $data[0]['properties']['discount'],
                    'tax_cost' => $data[0]['properties']['tax_total'],
                    'total_duel' => $data[0]['properties']['ship_cost'] + $data[0]['properties']['discount'] + $data[0]['properties']['tax_total'],
                    'amount' => $data[0]['properties']['amount'],
                    'customer_id' => $customer_id,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            } catch (\Exception $e) {
                return response()->json($e->getMessage());
            }
            //create PO detail
            foreach ($data[0]['detail']['product'] as $item) {
                // get po_id for database
                $po_id = DB::table('purchase_order_headers')->where('control_number', '=', $request->input('control_transaction'))->where('store_id', '=', $request->input('sender_id'))->first()->id;
                //get pid
                $product_code = "";
                foreach($included as $product_item){
                    if($product_item['type'] == $item['data']['type'] && $product_item['id'] == $item['data']['id']){
                        $product_code = $product_item['attributes']['code'];
                    }
                }
                $pid = DB::table('products')->where('product_code', $product_code)->where('store_id', $request->input('sender_id'))->first()->id;

                //create PO detail
                try {
                    DB::table('purchase_order_details')->insert([
                        'po_id' => $po_id,
                        'pid' => $pid,
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['unit_price'],
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
                } catch (\Exception $e) {
                    return response()->json($e->getMessage());
                }
            }
            return 1;
        }
    }

    public function verifyPO(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['Không tồn tại người dùng trong hệ thống'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
//        $receiver_id = 88888888;
//        return response()->json($request->all);

        $v = Validator::make($request->all(), [
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'time_interchange' => 'required|date_format:"Y-m-d H:i:s"',
            'data' => 'required|Array',
            'included' => 'required|Array'
        ]);
        if ($v->fails()) {
            return  $v->errors();
        }
//            return response()->json(compact('user'));

        // check permission
        if (!$user->can('send_po')) {
            return 'Permission denied';
        }
        // validate information
        if ($request->input('sender_id') != $user->store_id || $request->input('receiver_id') != 88888888) {
            return 'Wrong information';
        }

        // validate control_transaction
        $check_exist = POheader::where('control_number', '=', $request->input('control_transaction'))->first();
        if ($check_exist) {
            return 'duplicate control_transaction';
        }
        $store_code = Store::findOrFail($request->input('sender_id'))->control_code;
        $rule = "/^" . $store_code . "/";
//        dd($rule);
//        dd($request->input('control_transaction'));
        $check_format_code = preg_match($rule, $request->input('control_transaction'));

//        dd($check_format_code);
        if ($check_format_code == 0) {
            return 'Wrong format code';
        }


        return true;
        //

//

    }
}
