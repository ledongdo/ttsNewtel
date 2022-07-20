@extends('layouts.admin')
  @section('content')

  <div class="content-wrapper">
    <div class="content">
    <div class="container" style="padding-top: 30px;" ng-app="my-app" ng-controller="RoleController">
    
    <h2 align='center'>Danh Sách Role</h2>

    
    <div class="form-group">
   Search : <input type="text" ng-model="data.filter.freeText" ng-change="action.filter()">
 </div>
 <table class="table table-bordered" id="load">
   <thead>
     <tr class="Trtop">
       <th>STT</th>
       <th >Name</th>
       <th width="10%"><button id="btn-add" class="btn btn-primary btn-xs" ng-click="modal()">Thêm Role</button></th>
     </tr>
   </thead>
   <tbody>
     <tr ng-repeat="role in roles">
       <td>@{{role.id}}</td>
       <td>@{{role.name}}</td>
       <td>
         <button  class="btn btn-default btn-xs btn-detail" id="btn-edit" ng-click="modal(role.id)">Sửa</button>
         <button class="btn btn-danger btn-xs btn-delete" id="btn-delete" ng-click="action.delete(role.id)">Xóa</button>
       </td>
     </tr>
   </tbody>
 </table>
 <div class="row">
   <div class="col-sm-10">
     <button ng-click="action.paginate(pageNo)" ng-model="data.filter.page" ng-repeat="pageNo in pages">@{{ pageNo }}</button>
   </div>
   <div class="col-sm-2">
     <label for="">per page:</label>
     <select ng-model="data.filter.perPage" ng-change="action.filter()">
         <option ng-repeat="perPage in data.listPerPage" ng-value="perPage">@{{perPage}}</option>
     </select>
   </div>

 </div>

    
    <role-detail></role-detail>
  </div>
    </div>

  </div>
  @section('js')
  <script type="text/javascript" src="{{url('app/lib/factory/FactoryRole.js')}}"></script>
  <script type="text/javascript" src="{{url('app/lib/controller/RoleController.js')}}"></script>
  <script type="text/javascript" src="{{url('app/lib/directive/DirectiveRole.js')}}"></script>
  <script type="text/javascript">

  </script>
  @endsection
@endsection
