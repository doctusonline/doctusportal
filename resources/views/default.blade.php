<!DOCTYPE html>
<html lang="en">
<head>
    
        <link rel="icon" type="image/png" href="https://doctus.com.au/skin/frontend/default/doctus_theme/doctus-favicon.png">     
        
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('headtitle') | Doctus Online</title>

	<!-- <link href="{{ asset('/css/app.css') }}" rel="stylesheet"> -->

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://doctus.com.au/skin/frontend/default/doctus_theme/css/style.css">        
    
    <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap-datetimepicker.4.7.14.css') }} ">   -->
    <!-- laravel Styles -->
    <link rel="stylesheet" href="{{ asset('css/scss/default-k.css') }} ">  
    <link rel="stylesheet" href="{{ asset('css/scss/default-a.css') }} "> 
    
    <style>
        .dp-main-content { padding:30px 0; }
    </style>
    
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.0rc1/angular-resource.min.js"></script>
        
    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</head>

<body>
    
    <div id="main-wrapper" ng-app="doctusApp">

    <div class="main-content cms-page-custom"> <!-- CMS Page Content -->

        <div class="freeze"> <!-- freeze -->
            
             
        <nav class="navbar navbar-default"> 
               <div class="container"> <!-- Container -->
                    <div class="row"> <!-- Row -->
                        <div class="col-md-4 col-sm-4 left-search-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                        <span class="sr-only">Toggle Navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                </button>

<!--                            <form class="search-container" method="get" action="https://doctus.com.au/catalogsearch/result/">
                                  <input id="search_1" type="text" placeholder="Search" class="search-box snize-input-style" name="q" autocomplete="off">
                                  <label for="search_1"><span class="glyphicon glyphicon-search search-icon"></span></label>
                                  <input type="submit" id="search-submit">
                                </form>
-->

                        </div>
                                         <div class="col-md-8 col-sm-8">
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                                <ul class="nav navbar-nav navbar-right">
                                       <li> <a href="#">Orders (1)</a> </li>
                                        <li> <a href="#">My Inbox (2)</a> </li>
                                        
                                        
                                      
                                            
					@if (Auth::guest())
						<li> <a class="btn btn-default signin" href="{{ url('/auth/login') }}" role="button">Sign In</a> </li>
						<li> <a class="btn btn-default signup" href="{{ url('/auth/register') }}" role="button">REGISTER</a> </li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif                                            
                                            
                                       
                                        
                                </ul>
                                <ul class="top-mobile-clone">
                                        <li><a href="#">TEST</a></li>
                                        <li><a href="#">TEST II</a></li>
                                        <li><a href="#">TEST III</a></li>
                                </ul> 
                            </div>
                        </div>
                    </div> <!-- End Row -->
                </div><!-- End Container -->
        </nav>

            <div class="container">
                <div class="row " >
                    <div class="left col-md-3">
                        <a href="{{ url('/') }}"> <img class="img-responsive" src="https://doctus.com.au/skin/frontend/default/doctus_theme/images/logo.png" alt="doctus"> </a>
                    </div> 
                    <div class="right col-md-9">
                        
<!--                        <ul class="nav navbar-nav">
                            <li class=""> <a href="#">MEDICATIONS</a> </li> 
                                <li class=""> <a href="#">OUR SERVICES</a> </li>
                                <li class=""> <a href="#">ABOUT</a> </li>
                        </ul>-->
                        
                    </div>
                    <div class="clear"> </div>
                </div> <!--/logo -->
            </div>        
        </div> <!-- /freeze -->

            <section class="page-nav-title">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6"><h1>Doctor's Portal </h1></div>
                        <div class="col-md-6 col-sm-6">
                            <!--<div class="row">
                                    <div class="col-md-5 col-sm-5 center" style="float:right">
                                        <img src="https://doctus.com.au/skin/frontend/default/doctus_theme/images/flag-1.png"/><br />
                                        <span class="pharma">Australian Owned &amp; Operated</span>
                                    </div>
                                    <div class="col-md-4 col-sm-4 center" style="float:right">
                                        <img src="https://doctus.com.au/skin/frontend/default/doctus_theme/images/pharmacy-online.png" /><br />
                                        <span class="pharma">Medicines Provided by <br />Pharmacy Online</span>
                                    </div>
                                </div> -->
                        </div>
                    </div>
                </div>
            </section>
            
    </div> <!-- / CMS Page Content -->


    <div id="main-container" class="container"> <!-- Main Content -->
           <div class="row">
                
                        
                    @yield('content')
                    
                    
                
           </div>

    </div> <!-- / Main Content -->

    <section class="footer">
        <div class="container">

          <div class="row m-b-sm">
            <ul class="list-inline social">
              <li> <a target="_blank" href="https://twitter.com/DoctusAU"> <img src="https://doctus.com.au/skin/frontend/default/doctus_theme/images/twitter.png" /> </a> </li>
              <li> <a target="_blank" href="https://www.facebook.com/DoctusAU"> <img src="https://doctus.com.au/skin/frontend/default/doctus_theme/images/fb.png"  /> </a> </li>
              <li> <a target="_blank" href="http://instagram.com/DoctusAU"> <img src="https://doctus.com.au/skin/frontend/default/doctus_theme/images/insta.png"  /> </a> </li>
              <li> <a target="_blank" href="https://plus.google.com/101485100490271720381/posts?hl=en"> <img src="https://doctus.com.au/skin/frontend/default/doctus_theme/images/gplus.png"  /> </a> </li>
            </ul>    
          </div>

          <div class="row m-b-sm"><p>&copy; 2015 Doctus </p> <p> ABN (66 162 193 268)</p></div>
          <div class="row m-b-sm">
            <img src="https://doctus.com.au/skin/frontend/default/doctus_theme/images/footer-logo-doctus.png"/>
          </div>
        </div>
    </section> <!-- /Footer -->


    </div> <!-- /Main Wrapper -->
    
    
<!--	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Doctor's Portal</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>-->


    <!-- doctus custom js -->
    <script type="text/javascript" src="https://doctus.com.au/skin/frontend/default/doctus_theme/js/doctus-custom.js"> </script>        
        
</body>
</html>