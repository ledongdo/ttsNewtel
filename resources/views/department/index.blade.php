@extends('layouts.admin')
@section('content')

<div class="content-wrapper">
    <div class="content">
        <div class="container" style="padding-top: 30px;" ng-app="my-app" ng-controller="DepartmentController">
            <h2 align='center'>Danh Sách Department</h2>
            <div class="form-group">
                Search <input type="text" ng-model="data.filter.freeText" ng-change="action.filter()">
            </div>
            <div id="treeview" dx-tree-view="treeViewOptions" dx-item-alias="items">
                @{{items.name}}
                <span class="iconDepartment"><i class="fa-solid fa-plus" id="btn-addDepart" ng-click="modal()"></i></span>
                <span class="iconDepartment"><i class="fa-solid fa-user-pen" id="btn-editDepart" ng-click="modal(items.id)"></i></span>
                <span class="iconDepartment"><i class="fa-solid fa-delete-left" ng-click="action.delete(items.id)"></i></span>
            </div>
            
            <depart-detail depart-id="data.departId"></depart-detail>
        </div>
    </div>
</div>
@section('js')
<script type="text/javascript" src="{{url('app/lib/factory/DepartmentFactory.js')}}"></script>
<script type="text/javascript" src="{{url('app/lib/controller/DepartmentController.js')}}"></script>
<script type="text/javascript" src="{{url('app/lib/directive/DepartmentDirective.js')}}"></script>
<script type="text/javascript">

</script>
@endsection
@endsection