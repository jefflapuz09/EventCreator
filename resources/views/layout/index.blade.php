<?php 

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/toastr.css")}}">
    <link rel="stylesheet" href="{{asset("dist/font-awesome/css/font-awesome.css")}}">
    <link rel="stylesheet" href="{{asset("dist/fullcalendar/dist/fullcalendar.css")}}">
    <title>WEB APPLICATION!</title>
  </head>
  <body>
    @yield("content")  

    <script src="{{asset("js/jquery-3.3.1.min.js")}}"></script>
    <script src="{{asset("js/bootstrap.min.js")}}"></script>
    <script src="{{asset("js/toastr.min.js")}}"></script>
    <script src='{{asset('dist/moment/moment.js')}}'></script>
    <script src="{{asset("dist/fullcalendar/dist/fullcalendar.js")}}"></script>
    
    @yield("script")
    
    @if(Session::has('success'))
    <script>
        toastr.success("Message","{{Session::get('success')}}");
    </script>
    @endif
    
    @if($errors->count() > 0)
        @foreach($errors->all() as $error)
        <script>
        toastr.error("Message","{{$error}}");
        </script>
        @endforeach
    @endif
    
  </body>
</html>