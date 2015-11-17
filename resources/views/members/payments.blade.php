@extends('app')

@section('content')

<div id="page-content-wrapper">
	<div ng-controller="Dashboard as dash" class="container-fluid">
		<div id="page-wrapper">

			<div class="row">
				<div class="col-lg-12">
					<h1>Member Dashboard</h1>
					<h2>Welcome back, [[Auth::user()->first_name]] [[Auth::user()->last_name]]!</h2>
				</div>
				<!-- /.col-lg-12 -->
			</div>

			<div class="row">
				<div class="col-lg-6">
					<div class="col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-plane fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">26</div>
										<div>Q3 Practices</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /practices -->
					<div class="col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-fighter-jet fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">12</div>
										<div>Q3 Logged Scrimmages</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /scrimmages -->
					<div class="col-md-6">
						<div class="panel panel-red">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-plane fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">6</div>
										<div>Q3 Remaining Practices</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /practices -->
					<div class="col-md-6">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-fighter-jet fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">0</div>
										<div>Q3 Remaining Scrimmages</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /scrimmages -->
				</div><!-- /.col-lg-6 -->
				<div class="col-lg-6">
					<h4>Other functionality to add:</h4>
					<p>List of Email addresses</p>
					<p>Database of current skater derby numbers</p>

					<!-- <div class="dash-panel panel panel-default">
						<div class="panel-body">
							<ul class="chat">
								<li class="left clearfix">
									<span class="chat-img pull-left">
										<img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
									</span>
									<div class="chat-body clearfix">
											<div class="header">
												<strong class="primary-font">MHC Practice</strong>
												<small class="pull-right text-muted">
												    <i class="fa fa-clock-o fa-fw"></i> 24 hrs ago
												</small>
											</div>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.</p>
									</div>
								</li>
								<li class="right clearfix">
									<span class="chat-img pull-right">
										<img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
									</span>
									<div class="chat-body clearfix">
										<div class="header">
											<small class=" text-muted">
											    <i class="fa fa-clock-o fa-fw"></i> 13 mins ago</small>
											<strong class="pull-right primary-font">Bhaumik Patel</strong>
										</div>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.</p>
									</div>
								</li>
								<li class="left clearfix">
									<span class="chat-img pull-left">
										<img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
									</span>
									<div class="chat-body clearfix">
											<div class="header">
												<strong class="primary-font">Jack Sparrow</strong>
												<small class="pull-right text-muted">
												    <i class="fa fa-clock-o fa-fw"></i> 12 mins ago
												</small>
											</div>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.</p>
									</div>
								</li>
							</ul>
						</div>
					</div> -->
					<!-- /.panel .dash-panel -->

					<!-- <div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-bell fa-fw"></i> Notifications Panel
						</div>
						<div class="panel-body">
							<div class="list-group">
							    <a href="#" class="list-group-item">
							        <i class="fa fa-comment fa-fw"></i> New Comment
							        <span class="pull-right text-muted small"><em>4 minutes ago</em>
							        </span>
							    </a>
							    <a href="#" class="list-group-item">
							        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
							        <span class="pull-right text-muted small"><em>12 minutes ago</em>
							        </span>
							    </a>
							    <a href="#" class="list-group-item">
							        <i class="fa fa-envelope fa-fw"></i> Message Sent
							        <span class="pull-right text-muted small"><em>27 minutes ago</em>
							        </span>
							    </a>
							    <a href="#" class="list-group-item">
							        <i class="fa fa-tasks fa-fw"></i> New Task
							        <span class="pull-right text-muted small"><em>43 minutes ago</em>
							        </span>
							    </a>
							    <a href="#" class="list-group-item">
							        <i class="fa fa-upload fa-fw"></i> Server Rebooted
							        <span class="pull-right text-muted small"><em>11:32 AM</em>
							        </span>
							    </a>
							    <a href="#" class="list-group-item">
							        <i class="fa fa-bolt fa-fw"></i> Server Crashed!
							        <span class="pull-right text-muted small"><em>11:13 AM</em>
							        </span>
							    </a>
							    <a href="#" class="list-group-item">
							        <i class="fa fa-warning fa-fw"></i> Server Not Responding
							        <span class="pull-right text-muted small"><em>10:57 AM</em>
							        </span>
							    </a>
							    <a href="#" class="list-group-item">
							        <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
							        <span class="pull-right text-muted small"><em>9:49 AM</em>
							        </span>
							    </a>
							    <a href="#" class="list-group-item">
							        <i class="fa fa-money fa-fw"></i> Payment Received
							        <span class="pull-right text-muted small"><em>Yesterday</em>
							        </span>
							    </a>
							</div>
						</div>
					</div> -->
					<!-- /.panel - notifications -->

				</div><!-- /.col-lg-6 -->
				<!-- /.col-lg-12 -->
			</div>




				
<!-- 
			<p>A list of practices</p>

			[[$name or 'Default']] -->

		</div><!-- #page-wrapper -->
	</div><!-- /ng-controller -->

</div>

@endsection
