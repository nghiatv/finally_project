<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perms = Permission::all();
        return view('admin.listperm')->with('perms',$perms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_permission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
           'name'=>'required|unique:permissions',
            'display_name' => 'required|max:255',
            'description' => 'required|max:255'
        ]);
        if($validator->fails()){
            return Redirect::to('admin/perm/create')->withErrors($validator->errors());
        }else{
            $perm = new Permission();
            $perm->name = $request->input('name');
            $perm->display_name = $request->input('display_name');
            $perm->description = $request->input('description');
            $perm->save();

        return Redirect::to('admin/perm')->with('perm',$perm);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perm = Permission::findOrFail($id);
//        echo $perm;
        return view('admin/single_permission')->with('perm',$perm);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perm = Permission::findOrFail($id);
        return view('admin.edit_permission')->with('perm',$perm);
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
        $validator = Validator::make($request->all(),[
            'name'=>'required|',
            'display_name' => 'required|max:255',
            'description' => 'required|max:255'
        ]);
        if($validator->fails()){
            return Redirect::to('admin/perm/'.$id.'/edit')->withErrors($validator)->withInput($request->all());
        }
        else{
            $perm = Permission::findOrFail($id);
            $perm->name  = $request->input('name');
            $perm->display_name  = $request->input('display_name');
            $perm->description  = $request->input('description');
            $perm->save();

            return Redirect::to('admin/perm/'.$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perm = Permission::find($id);
        $perm->delete();

       return Redirect::to('admin/perm');
    }
}
