<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Permission;
use App\Role;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function Roles(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'page' => "required"
        ], [
            'page.required' => "Trang không được bỏ trống"
        ]);

        if ($validate->fails()) {
            throw new HttpResponseException(response()->json($validate->errors(), 422));
        }

        $perPage = $request->input('perPage', 10);
        $freeText = $request->freeText;

        $roles = Role::latest()->filterFreeText($freeText)->paginate($perPage);

        return response()->json([
            'error' => false,
            'roles' => $roles,

        ], 200);
    }

    public function index(){
        return view('role.index');
    }
    //show
    public function show($id){
        $roles = Role::find($id)->load('permissions');
		return response()->json([
			'error' => false,
			'roles'  => $roles,
		], 200);
    }
    //createRole
    public function store(RoleRequest $request)
    {
        $roles = new Role();
        $roles->name = $request->name;
        $roles->save();
        $roles->permissions()->attach($request->permission_id);
        return response()->json([
            'success' => 'sussess',
            'roles' =>   $roles,
        ],200);
    }
    //updateRole
    public function update($id,RoleRequest $request)
    {
        $roles = Role::find($id);
        $roles->name = $request->name;
        $roles->save();
        $roles->permissions()->sync($request->permission_id);

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
