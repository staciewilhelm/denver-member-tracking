@extends('app')

@section('content')
<div id="wrapper" ng-controller="Member as m" ng-class="{'toggled' : m.hideMemberSidebar}">
	<!-- Sidebar -->
	<div id="sidebar-wrapper">
		
		<div ng-if="m.showTransactions" class="member-sidebar transactions">
			<h3>Account Information</h3>

			<div class="form-group">
				<label class="block">Alternate Email</label>
				<input type="text" name="alt_email" class="form-control" placeholder="Alt. Email" value="[[ old('alt_email') ]]" />
			</div>

			<div class="form-group">
				<label class="block">Phone</label>
				<input type="text" name="phone" class="form-control" placeholder="Phone" value="[[ old('phone') ]]" />
			</div>

			<div class="form-group">
				<label class="block">Venmo Handle</label>
				<input type="text" name="venmo_handle" class="form-control" placeholder="Venmo Handle" value="[[ old('venmo_handle') ]]" />
			</div>

			<button class="btn btn-default">Update Account Information</button>

			<br clear="all" />
			<hr />

			<h3>New Venmo Payment</h3>

			<div class="form-group">
				<label class="block">Payment Amount</label>
				<input type="text" name="payment" class="form-control" placeholder="$0.00" value="[[ old('payment') ]]" />
			</div>

			<div class="form-group">
				<label class="block">Comment</label>
				<textarea class="form-control" placeholder="i.e. May Dues + Late Fee"></textarea>
			</div>

			<button class="btn btn-default">Make Payment to Denver Roller Derby</button>

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
								<p><strong>You last logged in on:</strong> [[ date('l, F j, Y', strtotime($user->last_logged))]] at [[ date('h:ia', strtotime($user->last_logged))]]</p>
								<p><strong>Clock-in Number:</strong> [[$user->clock_number]]</p>
								<p><strong>Email:</strong> <a href="mailto:[[$user->email]]">[[$user->email]]</a></p>
								<p><strong>Alt. Email:</strong> <a href="mailto:[[$user->alt_email]]">[[$user->alt_email]]</a></p>
								<p><strong>Phone:</strong> [[$user->phone]]</p>
								<p><strong>Venmo Handle:</strong> <a href="https://venmo.com/[[$user->venmo_handle]]" target="_blank">[['@'.$user->venmo_handle]]</a></p>

								<button class="btn btn-default" ng-class="{'btn-primary': !m.showTransactions}" ng-click="m.toggleMemberSidebar()">
									<span ng-if="!m.showTransactions">View</span><span ng-if="m.showTransactions">Hide</span>
									Update Account / New Venmo Payment
								</button>
								<button class="btn btn-default" ng-class="{'btn-primary': !m.showPracticeHistory}" ng-click="m.practiceHistory()">
									<span ng-if="!m.showPracticeHistory">View</span><span ng-if="m.showPracticeHistory">Hide</span> Logged Practices
								</button>
							</div>

							<div class="col-lg-6">
								<div class="dash-panel panel panel-default">
									<div class="panel-body">
										<ul class="chat">
											<li class="left clearfix">
												<span class="chat-img pull-left">
													<i class="fa fa-money fa-3x"></i>
												</span>
												<div class="chat-body clearfix">
														<div class="header">
															<strong class="primary-font">Paid to Denver Roller Derby: $60</strong>
															<small class="pull-right text-muted">
																<i class="fa fa-clock-o fa-fw"></i> 24 hrs ago
															</small>
														</div>
														<p>August Dues + Late Fee</p>
												</div>
											</li>
											<li class="right clearfix">
												<span class="chat-img pull-right">
													<i class="fa fa-credit-card fa-3x"></i>
												</span>
												<div class="chat-body clearfix">
													<div class="header">
														<small class=" text-muted">
														    <i class="fa fa-clock-o fa-fw"></i> 2 days ago</small>
														<strong class="pull-right primary-font">Charged by Denver Roller Derby: $60</strong>
													</div>
													<p>August Dues + Late Fee</p>
												</div>
											</li>
											<li class="left clearfix">
												<span class="chat-img pull-left">
													<i class="fa fa-money fa-3x"></i>
												</span>
												<div class="chat-body clearfix">
														<div class="header">
															<strong class="primary-font">Paid to Denver Roller Derby: $50</strong>
															<small class="pull-right text-muted">
																<i class="fa fa-clock-o fa-fw"></i> 2 months ago
															</small>
														</div>
														<p>July Dues</p>
												</div>
											</li>
											<li class="left clearfix">
												<span class="chat-img pull-left">
													<i class="fa fa-money fa-3x"></i>
												</span>
												<div class="chat-body clearfix">
														<div class="header">
															<strong class="primary-font">Paid to Denver Roller Derby: $50</strong>
															<small class="pull-right text-muted">
																<i class="fa fa-clock-o fa-fw"></i> 3 months ago
															</small>
														</div>
														<p>June Dues</p>
												</div>
											</li>
											<li class="left clearfix">
												<span class="chat-img pull-left">
													<i class="fa fa-money fa-3x"></i>
												</span>
												<div class="chat-body clearfix">
														<div class="header">
															<strong class="primary-font">Paid to Denver Roller Derby: $50</strong>
															<small class="pull-right text-muted">
																<i class="fa fa-clock-o fa-fw"></i> 4 months ago
															</small>
														</div>
														<p>May Dues</p>
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

						<div class="col-md-6">
							<div class="panel panel-red">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-fighter-jet fa-5x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge">1 / 1</div>
											<div>Q3 Remaining Activities</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- /remaining activites -->

						<div class="col-md-6">
							<div class="panel panel-red">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-money fa-5x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge">Marketing</div>
											<div>Current Committee</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- / remaining practices -->

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





