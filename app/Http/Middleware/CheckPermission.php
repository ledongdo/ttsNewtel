<?php

namespace App\Http\Middleware;

use App\Permission;
use App\Role;
use App\User;
use Closure;
use Illuminate\Support\Facades\DB;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permission = null)
    {
        //lay id role dang login
        
        $listRole = User::find(auth()->id())->roles()->select('roles.id')->pluck('id')->toArray();
        
        // lay quyen cua role dang login
        $listPermiss = DB::table('roles')
        ->join('permission_role','roles.id','=','permission_role.role_id')
        ->join('permissions','permission_role.permission_id','=','permissions.id')
        ->whereIn('roles.id', $listRole)
        ->select('permissions.*')
        ->get()->pluck('id')->unique();
        
        // //lay ra man hinh tuong ung de check phan quyen
        $checkPermission = Permission::where('name',$permission )->value('id');
        // dd($permission);
        //kiem tra user duoc phep vao khong
        if($listPermiss->contains($checkPermission)){
            return $next($request);
        }else{
            abort( response('Bạn không có quyền', 401) );

        }
        
    }
}
