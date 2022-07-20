@extends('layouts.admin')
  @section('content')

  <div class="content-wrapper">
    <div class="content">
        <div class="container"  >
            <h2>Bạn không có quyền,vui lòng quay lại</h2>
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
