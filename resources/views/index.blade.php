
<!DOCTYPE html>
<html lang="en" >

<head> 
  <meta charset="UTF-8" />
  <meta name="author" content="Do" />
  <title>Laravel 5.2 & Angular JS</title>
  <!-- Load Bootstrap CSS -->

<link type="text/css" rel="stylesheet" href="{{url('template/css/bootstrap.min.css')}}"/>
  <link type="text/css" rel="stylesheet" href="{{url('template/css/style.css')}}" />
  <script type="text/javascript" src="{{url('template/js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{url('template/js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{url('template/js/sweet2alert.js')}}"></script>

  <script type="text/javascript" src="{{url('app/lib/angular.min.js')}}"></script>
  <script type="text/javascript" src="{{url('app/app.js')}}"></script>
  <script type="text/javascript">
      var siteUrl = "{{ URL::to('/') }}";
  </script>
  <body>
  <div class="wrapper">
  
    @yield('content')

  </div>
  </body>
  </html>