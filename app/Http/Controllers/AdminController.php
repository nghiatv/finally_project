<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;

use App\Http\Requests;


use App\Permission;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;
use Log;
use DB;


class AdminController extends Controller
{
    //
    public function checkLogin()
    {

        if (Auth::check()) {

            $user = Auth::user();
            if ($user->hasRole('admin')) {

                return redirect()->intended('admin/dashboard');
            } else {
                return view('admin.login');
                return request()->json('error', 'masdasdsa');
            }
        } else return view('admin.login');
    }

    public function getLogin()
    {
        return Redirect::to('/');
    }

    public function getLogOut()
    {
        Auth::logout();
        return Redirect::to('/');
    }

    public function postLogin(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:32'
            ]);
        if ($validator->fails()) {

            return Redirect::to('/')->withErrors($validator->errors())->withInput();
        } else {

            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                $user = User::where('email', '=', $request->input('email'))->first();
                if ($user->hasRole('admin')) {
//                    Auth::login();
                    return Redirect::to('admin/dashboard');
                } else {
                    return Redirect::to('/')->with(['errors' => 'Permission Denied / Không có quyền']);
                }
            } else {
                return Redirect::to('/')->with(['errors' => 'Email hoặc mật khẩu không đúng.']);
//                return Redirect::to('/')->withErrors($validator->errors());
            }

        }

    }

    public function getUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin/single_user')->with('user', $user);
    }

    public function getCreateUser()
    {

        $roles = Role::all();
        $stores = Store::all();
//        var_dump($roles);
        return view('admin.create_user')->with('roles', $roles)->with('stores', $stores);
    }

    public function postUser(Request $request)
    {
//        echo var_dump(floatval($request->input('store')));
//        return response()->json($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:32',
            'store' => 'required'
        ]);
        if ($validator->fails()) {
            return Redirect::to('admin/user/create')->withErrors($validator->errors())->withInput($request->all());
        } else {
//            $user = User::where('email', '=', $request->input('email'))->first();
//            echo var_dump(intval($request->input('store')));

           try{
               User::create([
                   'name' => $request->input('name'),
                   'email' => $request->input('email'),
                   'password' => Hash::make($request->input('password')),
                   'store_id' => intval($request->input('store')),
               ]);
               $user = User::where('email', '=', $request->input('email'))->first();
               $role = Role::where('name', '=', $request->input('role'))->first();
               $user->attachRole($role->id);
           } catch(\Exception $e){
               return Redirect::to('admin/user/create')->with('errors',$e->getMessage())->withInput($request->all());
           }
            return Redirect::to('admin/user/create')->with('messages','tạo người dùng thành công');

        }


//        $user = User::where('email','=',$request->input('email'))->first();

    }

    public function getListUser()
    {
        $users = User::all();
//        $roles = Role::all();

        return view('admin/listUser')->with('users', $users);
    }


    public function index()
    {
        $users = User::all();
        return view('admin.listuser')->with('users', $users);
    }

    public function create()
    {
        $roles = Role::all();
        $stores = Store::all();
//        var_dump($roles);
        return view('admin.create_user')->with('roles', $roles)->with('stores', $stores);
    }

    public function store(Request $request)
    {
//        return $request->input();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:32',
            'store' => 'required'
        ]);
        if ($validator->fails()) {
            return Redirect::to('admin/user/create')->withErrors($validator->errors())->withInput();
        } else {
//            $user = User::where('email', '=', $request->input('email'))->first();
//            echo var_dump(intval($request->input('store')));

            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'store_id' => intval($request->input('store')),
            ]);
            $user = User::where('email', '=', $request->input('email'))->first();

            foreach ($request->input('roles') as $role) {
                $add_role = Role::where('name', '=', $role)->first();
                $user->roles()->attach($add_role->id);
            }


            return Redirect::to('admin/user');
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin/single_user')->with('user', $user);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $stores = Store::all();
//        $roles_of_user = $user->roles();
        $roles_of_user = DB::table('role_user')->select('role_user.role_id')->where('role_user.user_id', '=', $user->id)->get();

        return view('admin.edit_user')->with('user', $user)->with('roles', $roles)->with('stores', $stores)->with('roles_of_user', $roles_of_user);
    }

    public function update(Request $request, $id)
    {
//        return response()->json($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'store' => 'required'
        ]);
        if ($validator->fails()) {
            return Redirect::to('admin/user/' . $id . 'edit')->withErrors($validator->errors())->withInput();
        } else {
            $user = User::findOrFail($id);
            $user->update(['name' => $request->input('name')]);
            $user->update(['email' => $request->input('email')]);
            $user->update(['store_id' => intval($request->input('store'))]);
            $user->roles()->sync([]);
            foreach($request->input('roles') as $new_role){
                $role = Role::where('name', '=', $new_role)->first();
                $user->attachRole($role->id);
            }
            return Redirect::to('admin/user');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->forceDelete();
        return Redirect::to('admin/user');
    }

}
