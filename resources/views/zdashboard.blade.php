@extends('app')

@section('content')
<div id="wrapper" ng-controller="Member as m" ng-class="{'toggled' : m.hideMemberSidebar}">
	<!-- Sidebar -->
	<div id="sidebar-wrapper">
		
		<div ng-if="m.showTransactions" class="member-sidebar transactions">
			<h3>Account Information</h3>

			<div class="form-group col-lg-5">
				<label class="block">Account Type</label>
				<select>
					<option>Super</option>
					<option>Admin</option>
					<option>Member</option>
				</select>
			</div>

			<div class="form-group col-lg-7">
				<label class="block">Group</label>
				<select>
					<option>HR</option>
					<option>Facilities</option>
					<option>Training &amp; Recruitment</option>
				</select>
			</div>

			<div class="form-group col-lg-10">
				<label class="block">Clock-in number</label>
				<input class="form-control" placeholder="4-digit number">
				<br clear="all" />
				<button class="btn btn-default">Send activation email</button>
			</div>

			<br clear="all" />
			<hr />

			<h3>Financial Information</h3>

			<div class="form-group">
				<label class="checkbox-inline">
					<input type="checkbox">One-time membership fee
				</label>
			</div>
			
			<div class="form-group">
				<label class="block">Outstanding Debt?</label>
				<input type="text" placeholder="Amount Owed" class="form-control half" />
			</div>
			<div class="form-group">
				<input type="text" placeholder="Start Date" class="form-control sm" />
				<input type="text" placeholder="End Date" class="form-control sm" />
			</div>
			<div class="form-group">
				<textarea class="form-control" placeholder="Notes"></textarea>
			</div>
			<br clear="all" />

			<div class="form-group">
				<label class="block">Current Dues: Paid / Unpaid</label>
				<ul>
					<li>August Dues: <span class="warning">Unpaid</span> <span class="warning">Late</span></li>
					<li>July Dues: Paid</li>
					<li>June Dues: Paid</li>
					<li>May Dues: Paid <span class="warning">Late</span></li>
					<li>April Dues: Paid</li>
					<li>March Dues: Paid</li>
					<li>February Dues: Paid</li>
					<li>January Dues: Paid</li>
				</ul>
			</div>

			<div class="form-group">
				<label class="block">Other Transactions</label>
				<ul>
					<li>MHC NY Stipend: Received</li>
					<li>Concessions: Paid</li>
					<li>Crushers Jersey: Paid</li>
					<li>DRD Had: <span class="warning">Unpaid</span></li>
					<li>MHC Big-O Stipend: Received</li>
				</ul>
			</div>

			<button class="btn btn-default">See previous transactions</button>

			<br clear="all" />

		</div><!-- /.member-sidebar -->

		<div ng-if="m.showPracticeHistory" class="member-sidebar practice-history">
			<h3>Practice History</h3>

			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Q</th>
							<th>Type</th>
							<th>Title</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>

						<tr>
							<td>3</td>
							<td>Scrimmage</td>
							<td>MHC vs Fight Club</td>
							<td>8/19/15</td>
						</tr>

						<tr>
							<td>3</td>
							<td>Practice</td>
							<td>MHC</td>
							<td>8/17/15</td>
						</tr>

						<tr>
							<td>3</td>
							<td>Practice</td>
							<td>MHC</td>
							<td>8/14/15</td>
						</tr>

						<tr>
							<td>3</td>
							<td>Scrimmage</td>
							<td>MHC vs World</td>
							<td>8/12/15</td>
						</tr>

						<tr>
							<td>3</td>
							<td>Practice</td>
							<td>MHC</td>
							<td>8/10/15</td>
						</tr>

						<tr>
							<td>3</td>
							<td>Practice</td>
							<td>MHC</td>
							<td>8/07/15</td>
						</tr>

						<tr>
							<td>3</td>
							<td>Scrimmage</td>
							<td>MHC vs World</td>
							<td>8/05/15</td>
						</tr>

						<tr>
							<td>3</td>
							<td>Practice</td>
							<td>MHC</td>
							<td>8/03/15</td>
						</tr>

						<tr>
							<td>3</td>
							<td>Scrimmage</td>
							<td>MHC vs World</td>
							<td>7/29/15</td>
						</tr>

						<tr>
							<td>3</td>
							<td>Practice</td>
							<td>MHC</td>
							<td>7/27/15</td>
						</tr>

						<tr>
							<td>3</td>
							<td>Practice</td>
							<td>MHC</td>
							<td>7/24/15</td>
						</tr>

						<tr>
							<td>3</td>
							<td>Scrimmage</td>
							<td>B&amp;W Scrimmage</td>
							<td>7/22/15</td>
						</tr>

						<tr>
							<td>3</td>
							<td>Practice</td>
							<td>MHC</td>
							<td>7/20/15</td>
						</tr>

						<tr>
							<td>3</td>
							<td>Practice</td>
							<td>MHC</td>
							<td>7/27/15</td>
						</tr>

						<tr>
							<td>3</td>
							<td>Scrimmage</td>
							<td>MHC vs World</td>
							<td>7/15/15</td>
						</tr>

						<tr style="background-color:#c00 !important;">
							<td>3</td>
							<td>Practice</td>
							<td>MHC</td>
							<td>7/13/15</td>
						</tr>

						<tr>
							<td>3</td>
							<td>Practice</td>
							<td>MHC</td>
							<td>7/10/15</td>
						</tr>

					</tbody>
				</table>
			</div>

			<br clear="all" />

		</div><!-- /.practice-history -->
		
	</div>
	<!-- /#sidebar-wrapper -->

	<!-- Page Content -->
	<div id="page-content-wrapper">
		<div class="container-fluid">
			<div id="page-wrapper">

				<div class="row">
					<div class="col-lg-12">
						<h1>Welcome back, [[Auth::user()->first_name]] [[Auth::user()->last_name]]!</h1>

						<div class="row">
							<div class="col-lg-6">
								<p>You last logged in on: </p>
								<p>Your account information:</p>
								<p><strong>Email:</strong> wilhelm@denverrollerderby.org</p>
								<p><strong>Alt. Email:</strong> [[Auth::user()->email]]</p>
								<p><strong>Phone:</strong> 123-123-1234</p>
								<p><strong>Venmo Handle:</strong> @midgewilhelm</p>

								<button class="btn btn-default" ng-click="m.toggleMemberSidebar()">View Payments / Charges</button>
								<button class="btn btn-default" ng-click="m.practiceHistory()">View Logged Practices</button>
							</div>

							<div class="col-lg-6">
								<div class="dash-panel panel panel-default">
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
								</div>
								<!-- /.dash-panel -->
							</div>
							<br clear="all" />
						</div><!-- /.row -->
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->

				<div class="row">
					<div class="col-lg-8">
						<div class="col-md-6">
							<div class="panel panel-info">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-plane fa-5x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge">17</div>
											<div>Q3 Logged Practices</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- / logged practices -->
						<div class="col-md-6">
							<div class="panel panel-info">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-fighter-jet fa-5x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge">8</div>
											<div>Q3 Logged Scrimmages</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- / logged scrimmages -->
						<div class="col-md-6">
							<div class="panel panel-danger">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-plane fa-5x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge">6 / 23</div>
											<div>Q3 Remaining Practices</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- / remaining practices -->
						<div class="col-md-6">
							<div class="panel panel-success">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-fighter-jet fa-5x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge">0 / 8</div>
											<div>Q3 Remaining Scrimmages</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- /remaining scrimmages -->
						<div class="col-md-6">
							<div class="panel panel-red">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-money fa-5x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge">$50</div>
											<div>Due for April Dues</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- / remaining practices -->
						<div class="col-md-6">
							<div class="panel panel-warning">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-credit-card fa-5x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge">$50</div>
											<div>Last Payment: May Dues</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- /remaining scrimmages -->
					</div><!-- /.col-lg-6 -->
					<div class="col-lg-4">
						<h4>Helpful links:</h4>
						<p><a href="https://intranet.denverrollerderby.org" target="_blank">Intranet</a></p>
						<p><a href="http://calendar.denverrollerderby.org" target="_blank">Calendar</a></p>
						<p><a href="https://www.google.com/contacts/" target="_blank">DRD Contacts</a></p>
						<p><a href="https://groups.google.com/a/denverrollerderby.org/forum/#!forumsearch/" target="_blank">Google Groups</a></p>
						<br />
						<h4>Other functionality to add:</h4>
						<p>Database of current skater derby numbers</p>
					</div><!-- /.col-lg-6 -->
				</div><!-- /.row -->

			</div><!-- /#page-wrapper -->
		</div><!-- /.container-fluid -->
	</div><!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
@endsection





