<!DOCTYPE html>
<html lang="en" ng-app="denverTracking">
<head>
	<meta charset="utf-8">
	<base href="/">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Denver Tracking</title>

	<!-- Fonts -->
	<!-- <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type="text/css"> -->

	<link href="/css/framework.css" rel="stylesheet" type="text/css">
	<link href="/css/custom.css" rel="stylesheet" type="text/css">

	<!-- <link href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" rel="stylesheet" type="text/css"> -->

	<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="http://www.denverrollerderby.org">Denver Roller Derby</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
				@if (Auth::guest())
					<li><a href="/">Clock-In</a></li>
					<li><a href="/waiver">Waiver</a></li>
				@else
					<li><a href="/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
					@if (Auth::user()->have_role->name !== 'Member')
					<li><a href="/members"><i class="fa fa-user fa-fw"></i> Member Manager</a></li>
					<li><a href="/reports"><i class="fa fa-file-text-o fa-fw"></i></i> Reporting</a></li>
					<li><a href="/members/sync"><i class="fa fa-refresh fa-fw"></i></i> Sync Members</a></li>
					<li><a href="/payments/create"><i class="fa fa-credit-card fa-fw"></i></i> New Venmo Charge</a></li>
					@endif
				@endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="/auth/login">Login</a></li>
						<!-- <li><a href="/auth/register">Register</a></li> -->
					@else
						<li><a href="/auth/logout">Logout</a></li>
						<!-- <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">[[Auth::user()->first_name]] <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="/auth/logout">Logout</a></li>
							</ul>
						</li> -->
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<!-- 
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	 -->
	

	<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.3/angular.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.3/angular-resource.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.0/ui-bootstrap-tpls.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

<!-- located in example file -->

<!--
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script src="/js/morris-data.js"></script>
  -->


	<script src="/js/app.js"></script>
	<script src="/js/controllers/Dashboard.js"></script>
	<script src="/js/controllers/ClockIn.js"></script>
	<script src="/js/controllers/Member.js"></script>
	<script src="/js/controllers/Modal.js"></script>

	<script src="/js/services/clockin.js"></script>
	<script src="/js/services/user.js"></script>

</body>
</html>
