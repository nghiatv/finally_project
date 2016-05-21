<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.listrole')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perms = Permission::all();
        return view('admin.create_role')->with('perms', $perms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//       return response()->json($request->all());
//        $perm = $request->input()->all();
//        echo $perm;

        $validation = Validator::make($request->input(),
            [
                'name' => 'required|unique:roles|max:255',
                'display_name' => 'required|max:255',
                'description' => 'required|max:255'
            ]);
        if ($validation->fails()) {
            return Redirect::to('admin/role/create')->withErrors($validation->errors())->withInput();
        } else {

           try{
               $role = new Role();
               $role->name = $request->input('name');
               $role->display_name = $request->input('display_name'); // optional
               $role->description = $request->input('description'); // optional
               $role->save();

//            var_dump($request->input('perm'));
               $role->attachPermissions($request->input('perm'));

           }
           catch(\Exception $e){
               return Redirect::to('admin/role/create')->with('errors',$e->getMessage())->withInput();
           }

            return Redirect::to('admin/role');

        }


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

        $role = Role::find($id);
        return view('admin.single_role')->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $perms = Permission::all();
        $perms_of_role = $role->perms;
        return view('admin.edit_role')->with('role',$role)->with('perms',$perms)->with('perms_of_role',$perms_of_role);
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
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'display_name' => 'required|max:255',
            'description' => 'required|max:255',
            'perm' =>'required'
        ]);
        if($validator->fails()){
            return Redirect::to('admin/role/'.$id.'/edit')->withErrors($validator)->withInput($request->all());
        }
        else{
//            echo $request->input('perm');
           try{
               $role = Role::findOrFail($id);
               $role->name  = $request->input('name');
               $role->display_name  = $request->input('display_name');
               $role->description  = $request->input('description');
               $role->save();
               $role->perms()->sync([]); // Delete relationship data
               $role->attachPermissions($request->input('perm'));
           }
           catch(\Exception $e){
               return Redirect::to('admin/role/'.$id.'/edit')->with('errors',$e->getMessage())->withInput($request->all());
           }

            return Redirect::to('admin/role/'.$id.'/edit')->with('messages','Chỉnh sửa thành công')->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->perms()->sync([]); // Delete relationship data
        $role->users()->sync([]);
        $role->delete();




        return Redirect::to('admin/role');
    }
}
