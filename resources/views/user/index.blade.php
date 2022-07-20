@extends('layouts.admin')
  @section('content')
  <div class="content-wrapper">
    <div class="content">
    <div class="container" style="padding-top: 30px;" ng-app="my-app" ng-controller="UserController" >
 
 <h2 align='center'>Danh Sách User</h2>

 <div class="form-group">
   Search : <input type="text" ng-model="data.filter.freeText" ng-change="action.filter()">
 </div>
 <table class="table table-bordered" id="load">
   <thead>
     <tr class="Trtop">
       <th>STT</th>
       <th width="30%">Name</th>
       <th>Email</th>
       <th width="10%"><button id="btn-add" class="btn btn-primary btn-xs" ng-click="modal()">Thêm User</button></th>
     </tr>
   </thead>
   <tbody>
     <tr ng-repeat="user in users">
       <td>@{{user.id}}</td>
       <td>@{{user.name}}</td>
       <td>@{{user.email}}</td>
       <td>
         <button  class="btn btn-default btn-xs btn-detail" id="btn-edit" ng-click="modal(user.id)">Sửa</button>
         <button class="btn btn-danger btn-xs btn-delete" id="btn-delete" ng-click="action.delete(user.id)">Xóa</button>
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
         <option ng-repeat="perPage in data.listPerPage"  ng-value="perPage">@{{perPage}}</option>
     </select>
   </div>

 </div>

 <!-- Modal -->
 
 <user-detail></user-detail>
 
</div>
    </div>
  </div>
  
  <!-- Load Bootstrap JS -->
  @section('js')
  <script type="text/javascript" src="{{url('app/lib/factory/FactoryUser.js')}}"></script>
  <script type="text/javascript" src="{{url('app/lib/factory/FactoryRole.js')}}"></script>
  <script type="text/javascript" src="{{url('app/lib/controller/UserController.js')}}"></script>
  <script type="text/javascript" src="{{url('app/lib/directive/DirectiveUser.js')}}"></script>
  <script type="text/javascript">
  </script>
  @endsection
@endsection
