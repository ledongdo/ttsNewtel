<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        return view('department.index');
    }

    public function Departments(){
        $department = Department::get();
        return response()->json([
            'department' => $department,
            'status' => 'ok',
        ],200);
    }

    public function departDetail(){
        return view('department.detail');
    }

    public function show($id){
        $department = Department::find($id);
        return response()->json($department,200);
    }
    public function delete($id)
    {
        $department = Department::find($id)->delete();
        $department->departmentChildrent()->detach();
        return response()->json([
            'message' => 'Xóa thành công',
        ],200);
    }
}
