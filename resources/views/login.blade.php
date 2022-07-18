<!DOCTYPE html>
<html lang="en" ng-app="app-login">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link type="text/css" rel="stylesheet" href="{{url('template/css/bootstrap.min.css')}}" />
  <link type="text/css" rel="stylesheet" href="{{url('template/css/style.css')}}" />


  <script type="text/javascript" src="{{url('template/js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{url('template/js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{url('template/js/sweet2alert.js')}}"></script>

  <script type="text/javascript" src="{{url('app/lib/angular.min.js')}}"></script>
  <script type="text/javascript" src="{{url('app/app.js')}}"></script>
  <script type="text/javascript">
      var siteUrl = "{{ URL::to('/') }}";
  </script>
  <title>Document</title>
  <style>
    .formlogin{
      width: 800px;
    }
  </style>
</head>
<body>
    
<div class="container m-10 formlogin" ng-controller="LoginController">
      <h1>Form Login</h1>
      <form name="FrmLogin"  method="post">
      @csrf
      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" ng-model="user.email" >
        <span id="helpBlock2" class="help-block" ng-if="errorEmail" ng-repeat="error in errorEmail  ">@{{error}}</span>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" ng-model="user.password" >
        <span id="helpBlock2" class="help-block" ng-if="errorPassword" ng-repeat="error in errorPassword">@{{error}}</span>
        <span id="helpBlock2" class="help-block" ng-if="errorLogin">@{{errorLogin}}</span>
      </div>
      
      <button type="button" class="btn btn-primary" ng-click="save()">Submit</button>
    </form>
  </div>
</div>
<script type="text/javascript" src="{{url('app/lib/factory/FactoryLogin.js')}}"></script>
  <script type="text/javascript" src="{{url('app/lib/controller/LoginController.js')}}"></script>
<script type="text/javascript">

  </script>
</body>
</html>