<?php

namespace App\Http\Controllers;

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
use Illuminate\Contracts\Validation\ValidationException;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;
use Log;


class AdminController extends Controller
{
    //
    public function getLogin(){
        return Redirect::to('/');
    }
    public function getLogOut(){
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
        if($validator->fails()){

            return Redirect::to('/')->withErrors($validator->errors());
        }
        else{

            if(Auth::attempt(['email'=> $request->input('email'),'password' => $request->input('password') ])){
                $user = User::where('email', '=' , $request->input('email'))->first();
                if($user->hasRole('admin')){
                    return Redirect::to('admin/dashboard');
                }
                else{
                    return Redirect::to('/')->with(['errors' => 'Permission Denied / Không có quyền']);
                }
            } else{
                return Redirect::to('/')->with(['errors' => 'Email hoặc mật khẩu không đúng.']);
//                return Redirect::to('/')->withErrors($validator->errors());
            }

        }

    }
    public function getRegister(){
        return view('admin/register');
    }
}
