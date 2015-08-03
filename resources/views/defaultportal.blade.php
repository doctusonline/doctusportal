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
    
    <script type='text/javascript' src="{{ asset('js/jquery.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('js/angular/angular.min.js') }}"></script>
    <script data-require="angular-bootstrap@0.12.0" data-semver="0.12.0" src="{{ asset('js/angular/ui-bootstrap-tpls-0.12.0.min.js') }}"></script>
 
</head>

<body ng-app="orderApp">
    <div class="loading"></div>
    <div class="message-portal"></div>
    <div id="main-wrapper">

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
                            
                                <ul class="nav navbar-nav navbar-left">
                                    <li><a href="{{url('homepage')}}">Home</a> </li>
                                    <li><a href="{{url('orders')}}">Orders</a> </li>
                                    <li><a href="{{url('users')}}">Users</a> </li>
                                </ul>
                        </div>
                                         <div class="col-md-8 col-sm-8">
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                                <ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li> <a class="btn btn-default signin" href="{{ url('/auth/login') }}" role="button">Sign In</a> </li>
						<li> <a class="btn btn-default signup" href="{{ url('/auth/register') }}" role="button">REGISTER</a> </li>
					@else                        
                       <!--  <li> <a href="{{url('dashboard')}}">Dashboard</a> </li>
                        <li> <a href="{{url('users')}}">Users</a> </li> -->
                        
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hi, {{(Auth::user()->roles()->first()->slug == 'doctor') ? 'Dr.':''}} {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span class="caret"></span></a>
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
                        
                       
                    </div>
                    <div class="clear"> </div>
                </div> <!--/logo -->
            </div>        
        </div> <!-- /freeze -->

            <section class="page-nav-title">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6"><h1>@yield('headtitle')</h1></div>
                        <div class="col-md-6 col-sm-6">
                        </div>
                    </div>
                </div>
            </section>
            
    </div> <!-- / CMS Page Content -->
    <div ng-controller="initApp" id="main-container" class="container"> <!-- Main Content -->
           <div class="row">
            <div class="col-sm-3 content-bg">
                <h4>Navigation</h4>
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="javascript:void(0)">My Inbox (3)</a></li>
                  <li>
                    <a ng-show="awaiting_void" href="javascript:void(0)" ng-click="filterStatus('awaiting_doctor_review')">Awaiting Doctor Review (@{{awaiting_count}})</a>
                    <a ng-show="awaiting_url" href="{{url('orders')}}">Awaiting Doctor Review (@{{awaiting_count}})</a>
                  </li>                  
                  <li>
                    <a ng-show="prescription_void" href="javascript:void(0)" ng-click="filterStatus('prescription_approved')">Prescription Approved (@{{prescription_approved_count}})</a>
                    <a ng-show="prescription_url" href="{{url('orders')}}">Prescription Approved (@{{prescription_approved_count}})</a>
                  </li>

                </ul>
                <h4>Quick Select</h4>
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="#">[ Prescription Approved ]</a></li>
                </ul>
            </div>
            <div class="col-sm-9 content-bg">
                @yield('content')                    
            </div>
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
    
    

</body>
</html>