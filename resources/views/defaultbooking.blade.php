<!DOCTYPE html>
<html lang="en">
    <head>
        
        <link rel="icon" type="image/png" href="{{ asset('/images/doctus-favicon.png') }}">     
            
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>@yield('headtitle') | Doctus Online</title>

    	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    	<!--[if lt IE 9]>
    		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    	<![endif]-->


            <!-- laravel Styles -->
            
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
            <link rel="stylesheet" href="{{ asset('css/booking/style.css') }} ">  
            
            <link rel="stylesheet" href="{{ asset('css/scss/default-a.css') }} ">  
            <style>
                .dp-main-content { padding:30px 0; }
            </style>
            
            <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
            <script data-require="angular.js@1.2.x" src="//code.angularjs.org/1.2.1/angular-sanitize.js" data-semver="1.2.1"></script>
            
        <!-- Scripts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

    </head>


    <body>
        <div id="mainWrapper">
            <div id="header">
                <a href="#" class="logo">Doctus</a>
            </div><!-- END header -->
            <div id="wrapper">
                @yield('content')
            </div>
        </div>
    </body>
</html>