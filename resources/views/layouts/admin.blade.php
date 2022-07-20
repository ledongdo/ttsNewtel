<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminLTE 3 | Starter</title>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.min.js"></script>
  
  <link rel="stylesheet" href="{{url('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{url('adminlte/dist/css/adminlte.min.css')}}">
  <link type="text/css" rel="stylesheet" href="{{url('template/css/style.css')}}" />
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script type="text/javascript" src="{{url('template/js/sweet2alert.js')}}"></script>
    <script type="text/javascript" src="{{url('app/lib/angular.min.js')}}"></script>
    <script type="text/javascript" src="{{url('app/app.js')}}"></script>
    <script type="text/javascript">
        var siteUrl = "{{ URL::to('/') }}";
    </script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('partials.header')

  @include('partials.sidebar')

@yield('content')
  
  @include('partials.footer')
</div>
<script src="{{url('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('adminlte/dist/js/adminlte.min.js')}}"></script>
@yield('js')
</body>
</html>
