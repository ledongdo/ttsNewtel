<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //createUser
    public function store(UserCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->roles()->attach($request->role_id);
            DB::commit();
            return response()->json([
                'success' => 'success',
                'user'  => $user,
                'message' => 'Thêm thành công',
            ], 200);
        } catch (Exception $e) {
            error_log($e->getMessage());
            DB::rollBack();
        }
    }

    //showUser
    public function show(Request $request, $id)
    {
        $user = User::find($id)->load('roles');
        return response()->json([
            'error' => false,
            'user'  => $user,
        ], 200);
    }
    //UpdateUser
    public function update(UserUpdateRequest $request, $id)
    {
        $getUser =  User::find($id);
        if ($getUser->email !== $request->email) {
            if (User::where('email', $request->email)->exists()) {
                throw new Exception("email da ton tai", 422);
            }

            $user = User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user = User::find($id);
            $user->roles()->sync($request->role_id);
            return response()->json([
                'error' => false,
                'user'  => $user,
                'message' => 'Sửa thành công',
            ], 200);
        } else {

            $user = User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user = User::find($id);
            $user->roles()->sync($request->role_id);

            return response()->json([
                'error' => false,
                'user'  => $user,
                'message' => 'Sửa thành công',
            ], 200);
        }
    }

    //DeleteUser
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        $user->roles()->detach();
        return response()->json([
            'error' => false,
            'message' => 'Xóa thành công',
        ], 200);
    }


    public function index()
    {

        if (Auth::check()) {

            return view('user.index');
        } else {
            return redirect()->route('get-login');
        }
    }
    //User
    public function getUser(Request $request)
    {
        //validate
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

        $users = User::latest()->filterFreeText($freeText)->paginate($perPage);

        return response()->json([
            'error' => false,
            'users' => $users,

        ], 200);
    }
    public function userDetail()
    {
        return view('user.detail');
    }

}
