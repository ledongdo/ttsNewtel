<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['checkLogin'])->group(function () {
    
//users 
    Route::prefix('users')->group(function () {
        route::get('getUser',[UserController::class,'getUser'])->name('users.getUser');
        route::get('index',[UserController::class,'index'])->name('users.index')->middleware('checkPermiss:list-user');
        route::post('store',[UserController::class,'store'])->name('users.store')->middleware('checkPermiss:add-user');
        route::get('show/{id}',[UserController::class,'show'])->name('users.show');
        route::put('update/{id}',[UserController::class,'update'])->name('users.update')->middleware('checkPermiss:update-user');
        route::delete('delete/{id}',[UserController::class,'delete'])->name('users.delete')->middleware('checkPermiss:delete-user');
    
        route::get('userDetail',[UserController::class,'userDetail']);
        route::get('getRole',[UserController::class,'getRole']);
    });
//roles
    Route::prefix('roles')->group(function () {
        route::get('/',[RoleController::class,'Roles']);
        route::get('/index',[RoleController::class,'index'])->name('roles.index')->middleware('checkPermiss:list-role');
        route::post('store',[RoleController::class,'store'])->name('roles.store')->middleware('checkPermiss:add-role');
        route::get('show/{id}',[RoleController::class,'show'])->name('roles.show');
        route::put('update/{id}',[RoleController::class,'update'])->name('roles.update')->middleware('checkPermiss:update-role');
        route::delete('delete/{id}',[RoleController::class,'delete'])->name('roles.delete')->middleware('checkPermiss:delete-role');
        route::get('roleDetail',[RoleController::class,'roleDetail']);
        route::get('getPermisstion',[RoleController::class,'getPermisstion']);
    });
//Permission

});


route::get('login',[LoginController::class,'Login'])->name('get-login');
route::post('Postlogin',[LoginController::class,'postLogin'])->name('post-login');
route::get('logout',[LoginController::class,'logout'])->name('logout');
