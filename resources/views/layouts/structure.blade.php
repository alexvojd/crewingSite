<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Links -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="../../css/bootstrap.min.css" rel="stylesheet">
        <link href="../../css/bootstrap-grid.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../css/styles.css">
        
    </head>
    <body>

    <div class="wrap">
    	@include('layouts.header')
        
            <div class="container" id="content">
        		@yield('content')
            </div>
            
            <div class="container-fluid " id="content-fluid">
                @yield('content-fluid')
            </div>
    	@include('layouts.footer')
    </div>

        <!-- juqery -->
        <script src="../../js/jquery.js"></script>
        <script src="../../js/bootstrap.js"></script>
        <script src="../../js/jquery.nicescroll.js"></script> 
        <script src="../../js/scripts.js"></script>     
    </body>
</html>