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
    public function handle($request, Closure $next,$permissionCheck = null)
    {
        //lay id role dang login
        $roles = auth()->user()->roles;
        foreach($roles as $role)
        {
            //lay permissions theo role
            $permission = $role->permissions;
            if($permission->contains('name',$permissionCheck)){
                return $next($request);
            }
        }
        abort( response('Bạn không có quyền', 401) );



       
        
    }
}
