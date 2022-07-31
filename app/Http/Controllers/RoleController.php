<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RoleController extends Controller
{
    public function Roles()
    {
       $roles = Role::get();
       return response()->json([
        'success' => 'success',
        'roles' => $roles,
        ], 200);
    }

    public function index(){
        return view('role.index');
    }
    //show
    public function show($id){
        $roles = Role::find($id);
		return response()->json([
			'error' => false,
			'roles'  => $roles,
		], 200);
    }
    //createRole
    public function store(Request $request)
    {
        dd($request->all());
        // $roles = new Role();
        // $roles->name = $request->name;
        // $roles->save();
        // $roles->permissions()->attach($request->permission_id);
        // return response()->json([
        //     'success' => 'sussess',
        //     'roles' =>   $roles,
        // ],200);
    }
    //updateRole
    public function update($id,Request $request)
    {
        $roles = Role::find($id);
        $roles->name = $request->name;
        $roles->save();
        return response()->json([
            'success' => 'sussess',
            'roles' =>   $roles,
        ],200);
    }
    //deleteRole
    public function delete($id)
    {
        $roles = Role::find($id);
        $roles->delete();
		return response()->json([
			'error' => false,
			'message' => 'Xóa thành công',
		], 200);
    }
    //detailRole
    public function roleDetail(){
        return view('role.detail');
    }

    public function getPermisstion()
    {
        $permiss =  Permission::get();
        return response()->json([
            'sussess' => 'sussess',
            'permiss' => $permiss,
        ],200);
    }
}
