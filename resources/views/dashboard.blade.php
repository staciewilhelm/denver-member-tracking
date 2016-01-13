@extends('app')

@section('content')

<div id="wrapper" 
	ng-controller="Dashboard as d"
	ng-class="{'toggled' : d.hideMemberSidebar}"
	ng-init="d.setUserData([[$user]]);
		d.setUserBelongsData([[$user->validClockins]], [[$user->standings]], [[$user->transactions]]);
		d.setRequirementData([[$requirements]], [[$user->requirements]]);
		d.setRelatedData([[$user->committees]], [[$user->positions]], [[$user->teams]]);">

	<!-- Sidebar -->
	<div id="sidebar-wrapper">

		<div ng-if="d.showAccountInfo" class="member-sidebar transactions">
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

		<div ng-if="d.showRecentClockIns" class="member-sidebar practice-history">
			<h3>Recent Clock-ins</h3>
			<p><span class="warning">late clock-in / invalid practice</span></p>
			<p><i class="fa fa-check"></i> = on-time clock-in | <i class="fa fa-times"></i> = excused clock-in</p>

			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Q</th>
							<th>Type</th>
							<th>Title</th>
							<th>Date</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="c in d.userClockins" ng-class="{'invalid': c.invalid}">
							<td>{{c.qtr}}</td>
							<td>{{c.type | capitalize}}</td>
							<td>{{c.calendar_name}}</td>
							<td>{{c.calendar_date | date:'M/dd/yy'}}</td>
							<td class="center"><i class="fa" ng-class="{'fa-times': c.late_clockin, 'fa-check': !c.late_clockin}"></i></td>
						</tr>
					</tbody>
				</table>
			</div>

			<br clear="all" />

		</div><!-- /.member-sidebar clockins -->

	</div>
	<!-- /#sidebar-wrapper -->

	<!-- Page Content -->
	<div id="page-content-wrapper">
		<div class="container-fluid">
			<div id="page-wrapper" class="dashboard">

				<div class="row">
					<div class="col-lg-12">
<!-- 
					@foreach ($user->teams as $team)
					[[$team]]
					@endforeach
 -->
						<h1>Welcome back, {{d.user.first_name}} {{d.user.last_name}}!</h1>

						<div class="row">
							<div class="col-lg-6">
								<p><strong>You last logged in on:</strong> {{ d.user.last_logged | date:'EEEE, MMMM d, yyyy'}} at {{ d.user.last_logged | date:'h:mma'}}</p>

								<p><strong>Clock-in Number:</strong> {{d.user.clock_number}}</p>
								<p><strong>Email:</strong> <a href="mailto:{{d.user.email}}">{{d.user.email}}</a></p>
								<p><strong>Alt. Email:</strong> <a href="mailto:{{d.user.alt_email}}">{{d.user.alt_email}}</a></p>
								<p><strong>Phone:</strong> {{d.user.phone}}</p>
								<p><strong>Venmo Handle:</strong> <a href="https://venmo.com/{{d.venmoHandle}}" target="_blank">{{d.user.venmo_handle}}</a></p>
								<p><strong>Current Balance:</strong>
									<span ng-class="{'dashboard-warning': d.currBalance.pastDue}">${{d.currBalance.amount | number:2}}
										<span ng-if="d.balancePastDue">due ASAP</span>
									</span>
									<span ng-if="!d.currBalance.pastDue && d.currBalance.amount > 0">due on {{d.currBalance.dueDate | date:'EEEE, MMMM d, yyyy'}}</span>
									<span ng-if="d.currBalance.desc" ng-bind="d.currBalance.desc" class="lft-pad"></span>
								</p>

								<p><strong>HR status:</strong>
									<span ng-if="!d.activeStanding" ng-bind="d.memberStatus"></span>
									<span ng-if="d.activeStanding" ng-class="{'dashboard-warning': d.activeStanding.type !== 'LOA' && d.activeStanding.type !== 'Injury'}">
										{{d.activeStanding.type}} as of {{d.activeStanding.start_date | date:'EEEE, MMMM d, yyyy'}}
									</span>
								</p>

								<br clear="all" />
							</div>

							<div class="col-lg-6">

								<div class="col-lg-6">
									<h5>Current Committees:</h5>
									<p><i class="fa fa-object-ungroup"></i> 
										<span ng-if="d.committees.length > 0" ng-repeat="c in d.committees track by $index" ng-if="!c.isHead">
											<span ng-show="$index > 0">, </span>
											<a ng-if="c.googleRef" href="{{d.gURLs.groups}}{{c.googleRef}}" target="_blank">{{c.name}}</a>
											<span ng-if="!c.googleRef" ng-bind="c.name"></span>
										</span>
										<span ng-if="d.committees.length === 0"><strong>You are not currently on a committee</strong></span>
									</p>
									<p ng-if="d.isACommitteeHead"><strong>Head of:</strong>
										<span ng-repeat="c in d.committees track by $index" ng-if="c.isHead">
											<a ng-if="c.googleRef" href="{{d.gURLs.groups}}{{c.googleRef}}" target="_blank">{{c.name}}</a>
											<span ng-if="!c.googleRef" ng-bind="c.name"></span>
										</span>
									</p>

									<h5>Current Teams:</h5>
									<p><i class="fa fa-group"></i> 
										<span ng-repeat="t in d.teams track by $index"><span ng-show="$index > 0">, </span>{{t.name}}</span>
									</p>

									<p ng-if="d.coachTeams.length > 0"><strong>Coach of: </strong>
										<span ng-repeat="t in d.coachTeams track by $index"><span ng-show="$index > 0">, </span>{{t}}</span>
									</p>

									<p ng-if="d.captainTeams.length > 0"><strong>Captain of: </strong>
										<span ng-repeat="t in d.captainTeams track by $index"><span ng-show="$index > 0">, </span>{{t}}</span>
									</p>

									<div ng-if="d.positions.length > 0">
										<h5>Current Positions:</h5>
										<p><i class="fa fa-hand-spock-o"></i> 
											<span ng-repeat="p in d.positions track by $index">
												<span ng-show="$index > 0">, </span>{{p.name}}
											</span>
										</p>
									</div>
								</div>

								<div class="col-lg-6">
									<h5>Helpful links:</h5>
									<p><a href="{{d.gURLs.intranet}}" target="_blank">Intranet</a></p>
									<p><a href="{{d.gURLs.calendar}}" target="_blank">Calendar</a></p>
									<p><a href="{{d.gURLs.contacts}}" target="_blank">DRD Contacts</a></p>
									<p><a href="#" target="_blank">Sponsorships &amp; Discounts</a></p>
									<p><a href="{{d.gURLs.groupsSearch}}" target="_blank">Google Groups</a></p>
									<div class="modal-links" ng-if="d.teamClockinsStandings.length > 0">
										<p ng-repeat="tcr in d.teamClockinsStandings track by $index">
											<a href="#" ng-click="d.modalOpen('clockins-standings', tcr.id); $event.preventDefault();">{{tcr.name}} Clockins/Standings</a>
										</p>
									</div>

								</div>

								<!-- <div class="dash-panel panel panel-default">
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
								</div> -->




								<!-- /.dash-panel -->
							</div>
							<br clear="all" />
						</div><!-- /.row -->
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->

				<br clear="all" />

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
											<div class="huge">{{d.loggedPractices}}</div>
											<div>Q{{d.currentQuarter}} Logged Practices</div>
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
											<div class="huge">{{d.loggedScrimmages}}</div>
											<div>Q{{d.currentQuarter}} Logged Scrimmages</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- / logged scrimmages -->

						<div class="col-md-6" ng-repeat="(key, val) in d.remReqs">
							<div class="panel" 
								ng-class="{'panel-success': val.remaining === 0, 'panel-danger': val.remaining > 0}">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa  fa-5x"
											ng-class="{'fa-map-marker': key === 'activity', 
											'fa-trash': key === 'facility',
											'fa-object-ungroup': key === 'committee',
											'fa-gamepad': key === 'bout',
											'fa-plane': key === 'practice',
											'fa-fighter-jet': key === 'scrimmage'}"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge">{{val.remaining}} / {{val.required}}</div>
											<div>Q{{d.currentQuarter}} Remaining {{key | capitalize}}</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.col-lg-8 requirement counts -->
					
					<div class="col-lg-4">
						<button class="btn btn-default" ng-class="{'btn-primary': !d.showAccountInfo}" ng-click="d.toggleTransactions()">
							<span ng-if="!d.showAccountInfo">View</span><span ng-if="d.showAccountInfo">Hide</span>
							Update Account / New Venmo Payment
						</button>
						<br clear="all" /><br />
						<button class="btn btn-default" ng-class="{'btn-primary': !d.showRecentClockIns}" ng-click="d.toggleRecentClockins()">
							<span ng-if="!d.showRecentClockIns">View</span><span ng-if="d.showRecentClockIns">Hide</span> Logged Practices
						</button>

					</div><!-- /.col-lg-4 -->
				</div><!-- /.row -->

			</div><!-- /#page-wrapper -->
		</div><!-- /.container-fluid -->
	</div><!-- /#page-content-wrapper -->

	<script type="text/ng-template" id="clockinsStandings">
		@include('modals.clockins-standings')
	</script>

</div>
<!-- /#wrapper -->
@endsection

