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
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;
use Log;


class JwtAuthenticateController extends Controller
{
//    public  function __construct(){
//        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
//    }
    public function index(){
        $users = User::all();
        return $users;
    }
    public function admin(){
        return response()->json(['auth' => Auth::user(), 'users' => User::all()]);
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthenticateUser(){
        try{
            if( ! $user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['user_not_found'],404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e){
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }
    public function register(Request $request){
        $newuser = $request->all();
        $password = Hash::make($request->input('password'));
        $newuser['password'] = $password;
        $newuser = User::create($newuser);
        $role = Role::where('name','=',$request->input('role'))->first();
        $newuser->attachRole($role->id);
        return $newuser;
    }
    public function createRole(Request $request){
        $role = new Role();
        $check_role = Role::where('name','=',$request->input('name'))->first();
       if($check_role){
           return response()->json([
               "status_code" => 400,
               "status_name" => "Bad Request",
               "message" => "Duplicate role"
           ]);
       }else{
           $role->name = $request->input('name');
           $role->display_name = $request->input('display_name');
           $role->description = $request->input('description');
           $role->save();
           return response()->json([
               "status_code" => 200,
               "status_name" => "OK",
               "message" => "Created"
           ]);
       }

    }
    public function updateRole(Request $request){

        $role = Role::where('name','=',$request->input('name'))->first();
//        return $role;
        if(!$role){
            return response()->json([
                "status_code" => 404,
                "status_name" => "Not Found",
                "message" => "Role Not Found"
            ]);
        }else{
            $role->name = $request->input('new_name');
            $role->display_name = $request->input('display_name');
            $role->description = $request->input('description');
            $role->save();
            return $role;
        }
    }
    public function createPermission(Request $request){
        $viewUsers = new Permission();
        $viewUsers->name = $request->input('name');
        $viewUsers->display_name = $request->input('display_name');
        $viewUsers->description = $request->input('description');
//        $viewUsers->display_name = $request->input('display_name');
//        $viewUsers->setKeyName($request->input('name'));
        $viewUsers->save();
        return response()->json('created');
    }
    public function assignRole(Request $request){
        $user = User::where('email','=',$request->input('email'))->first();
        $role = Role::where('name','=',$request->input('role'))->first();
        $user->attachRole($role->id);
//        $user->roles()->attach($role->id);
        return response()->json('assigned');
    }
    public function attachPermission(Request $request){
        $role = Role::where('name', '=', $request->input('role_name'))->first();
        $permission = Permission::where('name', '=', $request->input('permission_name'))->first();
        $role->attachPermission($permission);


        return response()->json("created");
    }
    public function checkRoles(Request $request){
        $user = User::where('email', '=', $request->input('email'))->first();
        Log::info($user);
        return response()->json([
            "user" => $user,
            "client" => $user->hasRole('client'),
            "admin" => $user->hasRole('admin'),
            "editUser" => $user->can('create-users'),
            "listUsers" => $user->can('edit-users')
        ]);
    }
    public function allUsers(){
        $users = User::all();
        return $users;
    }
}
