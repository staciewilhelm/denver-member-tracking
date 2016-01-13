@extends('app')

@section('content')

@if (!empty($user))
	<div id="wrapper" 
	ng-controller="Member as m"
	ng-init="m.setUserData([[$user]]);
		m.setUserBelongsData([[$user->clockins]], [[$user->standings]], [[$user->transactions]]);
		m.setData('committees', [[$committees]], [[$user->committees]]);
		m.setData('positions', [[$positions]], [[$user->positions]]);
		m.setData('requirements', [[$requirements]], [[$user->requirements]]);
		m.setData('teams', [[$teams]], [[$user->teams]]);
		m.setData('groups', [[$groups]]);
		m.setData('roles', [[$roles]]);">
@else
	<div id="wrapper" 
	ng-controller="Member as m"
	ng-init="m.setData('committees', [[$committees]]);
		m.setData('positions', [[$positions]]);
		m.setData('requirements', [[$requirements]]);
		m.setData('teams', [[$teams]]);
		m.setData('groups', [[$groups]]);
		m.setData('roles', [[$roles]]);">
@endif

	<!-- Sidebar -->
	<div id="sidebar-wrapper">
		
		<div ng-cloak ng-if="m.showRecentTransactions" class="member-sidebar transactions">
			<h3>Recent Transactions</h3>

			<!-- <div class="form-group">
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
			<br clear="all" /> -->

			<div class="table-responsive">
				<label class="block">Venmo Payments &amp; Charges</label>
				<p>Red background indicates late or no payment</p>
				<table class="table table-hover">
					<thead>
						<tr>
							<th><i class="fa fa-exchange"></i></th>
							<th>Desc</th>
							<th>Amount</th>
							<th>Date</th>
							<th>Paid</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="t in m.userTransactions" ng-class="{'invalid':!t.trans_final}">
							<td><i class="fa" ng-class="{'fa-plus': t.type === 'Charge', 'fa-minus': t.type === 'Payment'}"></i></td>
							<td>{{t.desc}}</td>
							<td>
								<span ng-if="!t.trans_final">${{t.amount | number:2}}</span>
								<span ng-if="t.trans_final">${{t.trans_amount | number:2}}</span>
							</td>
							<td>{{t.due | date:'M/dd/yy'}}</td>
							<td class="center"><i ng-if="t.trans_final" class="fa fa-check"></i></td>
						</tr>
					</tbody>
				</table>
			</div>

			<!-- <div class="form-group">
				<label class="block">Current Dues: Paid / Unpaid</label>
				<ul>
					<li>August Dues: <span class="warning">Unpaid</span> <span class="warning">Late</span></li>
					<li>July Dues: <span class="warning">$50</span> Paid</li>
					<li>June Dues: Paid $50</li>
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
			</div> -->

			<button type="button" class="btn btn-default">View Transaction History</button>

			<br clear="all" />

		</div><!-- /.member-sidebar transactions -->

		<div ng-cloak ng-if="m.showRecentClockIns" class="member-sidebar practice-history">
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
						<tr ng-repeat="c in m.userClockins" ng-class="{'invalid': c.invalid}">
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

		<div ng-cloak ng-if="m.showUserStandings" class="member-sidebar standings">
			<h3>Past Standings</h3>
			<div ng-repeat="standing in m.userStandings" class="standing">
				<p class="header">
					<strong ng-class="{'warning': standing.type.indexOf('Warning') > -1}">{{standing.type}}</strong>
					<span class="dates">{{standing.start_date | date:'MMM. d, yyyy'}} - {{standing.end_date | date:'MMM. d, yyyy'}}</span>
				</p>
				<p>{{standing.notes}}</p>
				<p class="footer">Entered by <strong>{{standing.admin.first_name}} {{standing.admin.last_name}}</strong></p>
			</div>
			<br clear="all" />
		</div><!-- /.member-sidebar standings -->

	</div>
	<!-- /#sidebar-wrapper -->

	<!-- Page Content -->
	<div id="page-content-wrapper">
		<div class="container-fluid">
			<div id="page-wrapper">

				<div class="loading-spinner" ng-hide="m.loaded"><span class="fa fa-spinner fa-pulse fa-5x"></span></div>

				<form ng-cloak ng-show="m.loaded" name="memberForm" novalidate role="form" accept-charset="UTF-8" method="post" action="{{m.formAction}}">
					<input type="hidden" name="_token" value="[[ csrf_token() ]]">
					<input ng-if="m.action === 'update'" name="_method" type="hidden" value="put" />

					<div class="row">
						<div class="col-lg-12">
							<button class="btn btn-default">Back to Member Manager</button>
							<button class="btn btn-default" type="button" ng-click="m.submit(memberForm.$valid)">
								<span ng-show="m.action === 'create'">Save New Member Information</span>
								<span ng-show="m.action === 'update'">Save &amp; Update Member Information</span>
							</button>
							<strong ng-if="m.action === 'update'">&nbsp;&nbsp;|&nbsp;&nbsp;</strong>
							<button ng-if="m.action === 'update'" type="button" class="btn btn-default">View Transaction History</button>
							<button ng-if="m.action === 'update'" type="button" class="btn btn-default">View Clock-In History</button>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<h2 class="page-header">
								<span ng-show="m.action === 'create'">Add New Member</span>
								<span ng-show="m.action === 'update'">Member: {{m.user.first_name}} {{m.user.last_name}}
									<span ng-show="m.user.skater_name">({{m.user.skater_name}})</span>
								</span>
<!-- <button class="btn btn-default" ng-click="m.toggleMemberSidebar()">View Financial &amp; Account Information</button> -->
							</h2>
						</div>
					</div>

					<br />

					<div id="formData" class="row">
						<div class="col-lg-12">

							<div class="row">
								<div class="col-lg-6">

									<h5>Personal Information</h5>

									<div class="row form-group">
										<div class="col-lg-4" ng-class="{'val-err': memberForm.first_name.$invalid}">
											<label class="block">First Name</label>
											<div class="clear"></div>
											<input data-field
												type="text"
												class="form-control"
												placeholder="John"
												name="first_name"
												value="{{m.user.first_name}}"
												ng-model="m.user.first_name"
												ng-required="true" />
											<p class="val-err" ng-show="m.errors.first_name" ng-bind="m.errors.first_name"></p>
										</div>

										<div class="col-lg-4" ng-class="{'val-err': memberForm.last_name.$invalid}">
											<label class="block">Last Name</label>
											<div class="clear"></div>
											<input data-field
												type="text"
												class="form-control"
												placeholder="Smith"
												name="last_name"
												value="{{m.user.last_name}}"
												ng-model="m.user.last_name"
												ng-required="true" />
											<p class="val-err" ng-show="m.errors.last_name" ng-bind="m.errors.last_name"></p>
										</div>
									</div>
									<div class="clear"></div>

									<div class="row col-date form-group">
										<div class="col-lg-4" ng-class="{'val-err': memberForm.phone.$invalid}">
											<label class="block">Phone</label>
											<div class="clear"></div>
											<input data-field
												type="phone"
												class="form-control"
												placeholder="(111) 111-1111"
												name="phone"
												value="{{m.user.phone}}"
												ng-model="m.user.phone"
												ng-required="true" />
											<p class="val-err" ng-show="m.errors.phone" ng-bind="m.errors.phone"></p>
										</div>
										<div class="col-lg-4">
											<div class="datepicker-wrap" ng-class="{'val-err': memberForm.dob.$invalid}">
												<label class="block">DOB</label>
												<input data-field
												type="text"
												class="form-control half datepicker"
												placeholder="mm/dd/yyyy"
												name="dob"
												ng-value="m.user.dob"
												ng-model="m.dob"
												ng-required="true"
												datepicker-popup="{{m.dateFormat}}"
												datepicker-options="{{m.dateOptions}}"
												is-open="m.datepickers.dob" />
												<span class="input-group-btn">
													<button type="button" class="btn btn-default" ng-click="m.open($event,'dob')">
														<i class="fa fa-calendar"></i>
													</button>
												</span>
												<p class="val-err" ng-show="m.errors.dob" ng-bind="m.errors.dob"></p>
											</div><!-- /.datepicker-wrap -->
										</div>
									</div><!-- /.col-date -->

									<div class="form-group" ng-class="{'val-err': memberForm.alt_email.$invalid}">
										<label class="block">Alternate Email</label>
										<input data-field
												type="email"
												class="form-control half"
												placeholder="myawesomeemail@gmail.com"
												name="alt_email"
												ng-value="m.user.alt_email"
												ng-model="m.user.alt_email"
												ng-required="true" />
										<p class="val-err" ng-show="m.errors.alt_email" ng-bind="m.errors.alt_email"></p>
									</div>
								</div><!-- /personal information -->

								<div class="col-lg-6">
									<h5>Account Information</h5>

									<div class="row form-group">
										<div class="col-lg-4" ng-class="{'val-err': memberForm.role_id.$invalid}">
											<label class="block">Account Type</label>
											<select data-field
												name="role_id"
												required="true"
												ng-model="m.roleId"
												ng-change="m.updateValue('role', m.roleId)">
												<option
													ng-repeat="role in m.roles"
													ng-selected="m.user.role_id === role.id"
													value="{{role.id}}">{{role.name}}</option>
											</select>
											<p class="val-err" ng-show="m.errors.role_id" ng-bind="m.errors.role_id"></p>
										</div>

										<div class="col-lg-7">
											<label class="block">Account Group</label>
											<select data-field
												name="group_id"
												ng-model="m.groupId"
												ng-change="m.updateValue('group', m.groupId)">
												<option value="">None</option>
												<option
													ng-repeat="group in m.groups"
													ng-selected="m.user.group_id === group.id"
													value="{{group.id}}">{{group.name}}</option>
											</select>
											<p class="val-err" ng-show="m.errors.group_id" ng-bind="m.errors.group_id"></p>
										</div>
									</div>

									<div class="row form-group">
										<div class="col-lg-3" ng-class="{'val-err': memberForm.clock_number.$invalid}">
											<label class="block">Clock-in #</label>
											<input data-field
												type="text"
												class="form-control"
												placeholder="4-digit #"
												name="clock_number"
												ng-value="m.user.clock_number"
												ng-model="m.user.clock_number"
												ng-required="true" />
											<p class="val-err" ng-show="m.errors.clock_number" ng-bind="m.errors.clock_number"></p>
										</div>

										<div class="col-lg-4" ng-class="{'val-err': memberForm.password.$invalid}">
											<label class="block"><span ng-show="m.action === 'update'">Update </span>Password</label>
											<input data-field
												type="text"
												class="form-control"
												placeholder="8-15 characters"
												name="password"
												ng-value="m.user.password"
												ng-model="m.user.password"
												ng-required="m.action === 'create'" />
											<p class="val-err" ng-show="m.errors.password" ng-bind="m.errors.password"></p>
										</div>
										
										<div class="col-lg-4" ng-class="{'val-err': memberForm.password_confirmation.$invalid}">
											<label class="block">Confirm Password</label>
											<input data-field
												type="text"
												class="form-control"
												placeholder="Re-type password"
												name="password_confirmation"
												ng-value="m.user.password_confirmation"
												ng-model="m.user.password_confirmation"
												ng-required="m.action === 'create' || m.user.password" />
											<p class="val-err" ng-show="m.errors.password_confirmation" ng-bind="m.errors.password_confirmation"></p>
										</div>

										<div ng-if="m.user.mem_status !== 'Alumni' && m.user.mem_status !== 'Retired'" class="col-lg-4">
											<label class="block">&nbsp;</label>
											<button type="button" class="btn btn-default">
												<span ng-if="m.user.mem_status === 'Active'">Re-</span>Send activation email
											</button>
										</div>
									</div>

									<div class="row form-group">
										<div class="col-lg-12">
											<h5>Payment Information</h5>
										</div>
										<div class="col-lg-7" ng-class="{'val-err': memberForm.venmo_handle.$invalid}">
											<label class="block">Venmo Handle</label>
											<input data-field
												type="text"
												class="form-control"
												placeholder="@Stacie-Wilhelm"
												name="venmo_handle"
												ng-value="m.user.venmo_handle"
												ng-model="m.venmoHandle"
												ng-required="true"
												ng-change="m.prepend('@')" />
											<p class="val-err" ng-show="m.errors.venmo_handle" ng-bind="m.errors.venmo_handle"></p>
										</div>

										<div class="col-lg-4">
											<label class="block">&nbsp;</label>
											<button type="button" class="btn btn-default" 
												ng-show="m.action === 'update'"
												ng-class="{'btn-primary selected': m.showRecentTransactions}" 
												ng-click="m.toggleRecentTransactions()">
												View<span ng-show="m.showRecentTransactions">ing</span> Recent Transactions
											</button>
										</div>
									</div>

								</div><!-- /account information -->
							</div><!-- /.row personal/league information -->

							<hr />

							<div class="row">
								<div class="col-lg-6">
									<h5>League &amp; Skater Information</h5>

									<div class="row">
										<div class="form-group col-lg-4" ng-class="{'val-err': memberForm.mem_status.$invalid}">
											<label class="block">Member Status</label>
											<select data-field
												name="mem_status"
												ng-model="m.memberStatus"
												ng-change="m.updateValue('memberStatus', m.memberStatus)">
												<option value="">Choose One&hellip;</option>
												<option
													ng-repeat="status in m.memberStatuses"
													ng-selected="m.user.mem_status === status"
													value="{{status}}">{{status}}</option>
											</select>
											<p class="val-err" ng-show="m.errors.mem_status" ng-bind="m.errors.mem_status"></p>
										</div>

										<div class="form-group" ng-if="m.memberStatus === 'Active'">
										<label class="block">&nbsp;</label>
											<label class="checkbox-inline">
												<input data-field
													type="checkbox"
													name="gd_access"
													ng-value="m.user.gd_access"
													ng-model="m.user.gd_access" />GD Access?
											</label>
										</div>

										<div ng-if="m.memberStatus === 'Retired'" class="form-group datepicker-wrap" ng-class="{'val-err': memberForm.retired_date.$invalid}">
											<label class="block">Retired Date</label>
											<input data-field
												type="text"
												class="form-control half datepicker"
												placeholder="mm/dd/yyyy"
												name="retired_date"
												ng-value="m.user.retired_date"
												ng-model="m.user.retired_date"
												ng-required="m.memberStatus === 'Retired'"
												datepicker-popup="{{m.dateFormat}}"
												datepicker-options="{{m.dateOptions}}"
												is-open="m.datepickers.retired_date" />
											<span class="input-group-btn">
												<button type="button" class="btn btn-default" ng-click="m.open($event,'retired_date')">
													<i class="fa fa-calendar"></i>
												</button>
											</span>
											<p class="val-err" ng-show="m.errors.retired_date" ng-bind="m.errors.retired_date"></p>
										</div>
									</div><!-- / member status row -->

									<div class="row form-group" ng-class="{'val-err': memberForm.mem_type.$invalid}">
										<div class="col-lg-4">
											<label class="block select-lbl">Member Type</label>
											<select data-field
												name="mem_type"
												ng-model="m.memberType"
												ng-required="m.memberStatus === 'Active'"
												ng-change="m.updateValue('memberType', m.memberType)">
												<option value="">Choose One&hellip;</option>
												<option
													ng-repeat="type in m.memberTypes"
													ng-selected="m.user.mem_type === type"
													value="{{type}}">{{type}}</option>
											</select>
											<p class="val-err" ng-show="m.errors.mem_type" ng-bind="m.errors.mem_type"></p>
										</div>

										<!-- <div class="col-lg-4" ng-if="m.memberType === 'Skater'" ng-class="{'val-err': memberForm.mem_level.$invalid}">
											<label class="block select-lbl">Member Level</label>
											<select data-field
												name="mem_level"
												ng-model="m.memberLevel"
												ng-change="m.updateValue('memberLevel', m.memberLevel)">
												<option value="">Choose One&hellip;</option>
												<option
													ng-repeat="level in m.memberLevels"
													ng-selected="m.user.mem_level === level"
													value="{{level}}">{{level}}</option>
											</select>
											<p class="val-err" ng-show="m.errors.mem_level" ng-bind="m.errors.mem_level"></p>
										</div> -->

										<div class="col-lg-4" ng-if="m.memberType === 'Skater'" ng-class="{'val-err': memberForm.skater_level.$invalid}">
											<label class="block select-lbl">Skater Level</label>
											<select data-field
												name="skater_level"
												ng-model="m.skaterLevel"
												ng-required="m.memberType === 'Skater'"
												ng-change="m.updateValue('skaterLevel', m.skaterLevel)">
												<option value="">Choose One&hellip;</option>
												<option
													ng-repeat="level in m.skaterLevels"
													ng-selected="m.user.skater_level === level"
													value="{{level}}">{{level}}</option>
											</select>
											<p class="val-err" ng-show="m.errors.skater_level" ng-bind="m.errors.skater_level"></p>
										</div>

									</div><!-- / member type row -->

									<div class="row form-group">
										<div class="col-lg-4" ng-class="{'val-err': memberForm.skater_name.$invalid}">
											<label class="block">Skater Name</label>
											<input data-field
												type="text"
												class="form-control"
												placeholder="Midge Mayhem"
												name="skater_name"
												value="{{m.user.skater_name}}"
												ng-model="m.user.skater_name"
												ng-required="m.memberStatus === 'Active'" />
											<p class="val-err" ng-show="m.errors.skater_name" ng-bind="m.errors.skater_name"></p>
										</div>
										<div class="col-lg-2" ng-class="{'val-err': memberForm.skater_name.$invalid}">
											<label class="block">Skater #</label>
											<input data-field
												type="text"
												class="form-control"
												placeholder="20"
												name="skater_no"
												ng-value="m.user.skater_no"
												ng-model="m.user.skater_no"
												ng-required="m.memberStatus === 'Active'"
												ng-disabled="m.memberLevel === 'Level 1' || m.memberLevel === 'Level 2'" />
											<p class="val-err" ng-show="m.errors.skater_no" ng-bind="m.errors.skater_no"></p>
										</div>

										<div class="col-lg-6" ng-class="{'val-err': memberForm.identifies_as.$invalid}">
											<label class="block">Identifies as</label>
											<label class="checkbox-inline">
												<input data-field
													type="radio"
													name="identifies_as"
													id="Male"
													value="Male"
													ng-model="m.identifiesAs"
													ng-required="m.memberStatus === 'Active'" />&nbsp;&nbsp;Male
											</label>
											<label class="checkbox-inline">
												<input data-field
													type="radio"
													name="identifies_as"
													id="Female"
													value="Female"
													ng-model="m.identifiesAs"
													ng-required="m.memberStatus === 'Active'" />&nbsp;&nbsp;Female
											</label>
											<p class="val-err" ng-show="m.errors.identifies_as" ng-bind="m.errors.identifies_as"></p>
										</div>
									</div>

									<div class="row col-date form-group">
										<div class="datepicker-wrap col-lg-4" ng-class="{'val-err': memberForm.join_date.$invalid}">
											<label class="block">Join Date</label>
											<input data-field
												type="text"
												class="form-control half datepicker"
												placeholder="mm/dd/yyyy"
												name="join_date"
												ng-value="m.user.join_date"
												ng-model="m.user.join_date"
												ng-required="m.memberStatus === 'Active'"
												datepicker-popup="{{m.dateFormat}}"
												datepicker-options="{{m.dateOptions}}"
												is-open="m.datepickers.join_date" />
											<span class="input-group-btn">
												<button type="button" class="btn btn-default" ng-click="m.open($event,'join_date')">
													<i class="fa fa-calendar"></i>
												</button>
											</span>
											<p class="val-err" ng-show="m.errors.join_date" ng-bind="m.errors.join_date"></p>
										</div>
										<div class="datepicker-wrap col-lg-4" ng-class="{'val-err': memberForm.induction_date.$invalid}">
											<label class="block">Induction Date</label>
											<input data-field
												type="text"
												class="form-control half datepicker"
												placeholder="mm/dd/yyyy"
												name="induction_date"
												ng-value="m.user.induction_date"
												ng-model="m.user.induction_date"
												ng-required="m.memberStatus === 'Active'"
												datepicker-popup="{{m.dateFormat}}"
												datepicker-options="{{m.dateOptions}}"
												is-open="m.datepickers.induction_date" />
											<span class="input-group-btn">
												<button type="button" class="btn btn-default" ng-click="m.open($event,'induction_date')">
													<i class="fa fa-calendar"></i>
												</button>
											</span>
											<p class="val-err" ng-show="m.errors.induction_date" ng-bind="m.errors.induction_date"></p>
										</div>
										<div class="col-lg-4" ng-class="{'val-err': memberForm.wftda_insurance_no.$invalid}">
											<label class="block">WFTDA Insurance #</label>
											<input data-field
												type="text"
												class="form-control half"
												placeholder="12345"
												name="wftda_insurance_no"
												ng-value="m.user.wftda_insurance_no"
												ng-model="m.user.wftda_insurance_no"
												ng-required="m.memberStatus === 'Active'" />
											<p class="val-err" ng-show="m.errors.wftda_insurance_no" ng-bind="m.errors.wftda_insurance_no"></p>
										</div>
									</div><!-- /.col-date induction / join -->

									<div class="row form-group">
										<div class="col-lg-6">
											<label class="block">Signed?</label>
											<label class="checkbox-inline">
												<input type="checkbox" name="signed_waiver" value="1" ng-checked="m.user.signed_waiver">DRD Waiver
											</label>
											<label class="checkbox-inline">
												<input type="checkbox" name="signed_coc" value="1" ng-checked="m.user.signed_coc">Code of Conduct
											</label>
										</div>
										<div class="col-lg-6">
											<label class="block">Paid?</label>
											<label class="checkbox-inline">
												<input type="checkbox" name="paid_mem_fee" value="1" ng-checked="m.user.paid_mem_fee">One-time membership fee
											</label>
										</div>
									</div>

									<div class="row col-date form-group">
										<div class="col-lg-6" ng-class="{'val-err': memberForm.transfer_from.$invalid}">
											<label>Transfer?
												<input type="checkbox" name="is_transfer" value="1" ng-model="m.isTransfer" ng-checked="m.user.is_transfer">
											</label>
											<div class="clear"></div>
											<input data-field
												type="text"
												class="form-control"
												placeholder="Previous League"
												name="transfer_from"
												ng-value="m.user.transfer_from"
												ng-model="m.user.transfer_from"
												ng-if="m.isTransfer"
												ng-required="m.isTransfer" />
											<p class="val-err" ng-show="m.errors.transfer_from" ng-bind="m.errors.transfer_from"></p>
										</div>
										<div class="col-lg-6">
											<div ng-if="m.isTransfer" class="datepicker-wrap" ng-class="{'val-err': memberForm.transfer_date.$invalid}">
												<label class="block">Transfer Date</label>
												<input data-field
													type="text"
													class="form-control half datepicker"
													placeholder="mm/dd/yyyy"
													name="transfer_date"
													ng-value="m.user.transfer_date"
													ng-model="m.user.transfer_date"
													ng-required="m.isTransfer"
													datepicker-popup="{{m.dateFormat}}"
													datepicker-options="{{m.dateOptions}}"
													is-open="m.datepickers.transfer_date" />
												<span class="input-group-btn">
													<button type="button" class="btn btn-default" ng-click="m.open($event,'transfer_date')">
														<i class="fa fa-calendar"></i>
													</button>
												</span>
												<p class="val-err" ng-show="m.errors.transfer_date" ng-bind="m.errors.transfer_date"></p>
											</div>
										</div>
									</div><!-- / transfer row -->

								</div><!-- /.col-lg-6 -->
								
								<div class="col-lg-6">
									<h5>HR Specifics
										<button type="button" class="btn btn-default btn-inline" 
											ng-show="m.action === 'update'"
											ng-class="{'btn-primary selected': m.showUserStandings}" 
											ng-click="m.toggleUserStandings()">
												View<span ng-show="m.showUserStandings">ing</span> Past Standings
										</button>
									</h5>

									<div class="row form-group col-lg-12">
										<label class="checkbox-inline no-lft">
											<input type="radio" name="activeStanding[type]" 
												id="Warning" value="Warning" 
												ng-checked="m.activeStanding.type">&nbsp;&nbsp;Warning
										</label>
										<label class="checkbox-inline no-lft">
											<input type="radio" name="activeStanding[type]" 
												id="Double Warning" value="Double Warning" 
												ng-checked="m.activeStanding.type">&nbsp;&nbsp;Double Warning
										</label>
										<label class="checkbox-inline">
											<input type="radio" name="activeStanding[type]" 
												id="LOA" value="LOA" 
												ng-checked="m.activeStanding.type">&nbsp;&nbsp;LOA
										</label>
										<label class="checkbox-inline">
											<input type="radio" name="activeStanding[type]" 
												id="Injury" value="Injury" ng-checked="m.activeStanding.type">&nbsp;&nbsp;Injury
										</label>
									</div><!-- end warning -->

									<div class="row col-date form-group">
										<div class="datepicker-wrap col-lg-4">
											<label class="block">Start Date</label>
											<datepicker-activestandingstart></datepicker-activestandingstart>
										</div>
										<div class="datepicker-wrap col-lg-4">
											<label class="block">End Date</label>
											<datepicker-activestandingend></datepicker-activestandingend>
										</div>
									</div><!-- /.col-date start & end date -->
									
									<p ng-if="m.activeStanding.end_date"><strong>Setting an end date will mark this standing as complete upon save.</strong></p>

									<div class="row form-group col-lg-12">
										<textarea class="notes form-control" 
											placeholder="LOA Notes" name="activeStanding[notes]">{{m.activeStanding.notes}}</textarea>
										<input type="hidden" name="activeStanding[id]" value="{{m.activeStanding.id}}" />
									</div>

									<div class="row form-group col-lg-12" ng-if="m.memberType !== 'Volunteer'">

										<p ng-if="m.memberType === 'Associate'">Associate Monthly dues are $15</p>

										<div ng-if="(m.memberType === 'Skater') && m.memberLevel">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Price/mo per Year</th>
														<th>Price/mo per Quarter</th>
														<th>Price/mo</th>
													</tr>
												</thead>
												<tbody>
													<tr class="gradeX">
														<td>$40</td>
														<td>$45</td>
														<td>$50</td>
													</tr>

													<tr ng-if="m.memberLevel !== 'Level 1'" class="gradeX">
														<td>$75</td>
														<td>$80</td>
														<td>$85</td>
													</tr>

													<tr ng-if="m.memberLevel !== 'Level 1' && m.memberLevel !== 'Level 2'" class="gradeX">
														<td>$110</td>
														<td>$115</td>
														<td>$120</td>
													</tr>

													<tr ng-if="m.memberLevel === 'Level 4'" class="gradeX">
														<td>$140</td>
														<td>$145</td>
														<td>$150</td>
													</tr>

													<tr ng-if="m.memberLevel === 'Level 5' || m.memberLevel === 'Level 6'" class="gradeX">
														<td>$175</td>
														<td>$180</td>
														<td>$185</td>
													</tr>
												</tbody>
											</table>
										</div><!-- ng-if member_type & member_level -->

									</div><!-- ng-if !Volunteer -->

								</div><!-- /.col-lg-6 -->
							</div><!-- /.row committees / skater information -->

							<hr />

							<div class="row">
								<div class="col-lg-6">
									<div class="row form-group">
										<div class="col-lg-4">
											<label class="block">Committees</label>
											<div ng-repeat="c in m.committees.left" class="checkbox">
												<label>
													<input type="checkbox" name="user_committees[]" value="{{c.id}}" ng-checked="{{c.checked}}"> {{c.name}}
												</label>
											</div>
										</div><!-- / end committees left -->

										<div class="col-lg-4">
											<label class="block">&nbsp;</label>
											<div ng-repeat="c in m.committees.right" class="checkbox">
												<label>
													<input type="checkbox" name="user_committees[]" value="{{c.id}}" ng-checked="{{c.checked}}"> {{c.name}}
												</label>
											</div>
										</div><!-- / end committees right -->

										<div class="col-lg-4">
											<label class="block">Positions</label>
											<div ng-repeat="p in m.positions" class="checkbox">
												<label>
													<input type="checkbox" name="user_positions[]" value="{{p.id}}" ng-checked="{{p.checked}}"> {{p.name}}
												</label>
											</div>
										</div><!-- / end roles -->
									</div><!-- / end committees row -->

								</div><!-- /.col-lg-6 committees & roles -->

								<div class="col-lg-6">
									<!-- <div class="col-lg-6" ng-if="m.memberLevel === 'Level 5' || m.memberLevel === 'Level 6'"> -->
									<div class="col-lg-6" ng-if="m.memberType === 'Skater'">
										<label class="block">Home Teams</label>
										<div ng-repeat="homeTeam in m.homeTeams">
											<div class="checkbox">
												<label class="checkbox-inline no-lft">
													<input type="radio" name="teams[{{homeTeam.id}}][id]" value="{{homeTeam.id}}" 
														ng-model="m.selectedHomeTeam" 
														ng-change="m.enableTeamRoles(homeTeam.id)"> {{homeTeam.name}}
												</label>
											</div>
											<div ng-if="m.selectedHomeTeam === homeTeam.id" class="lft-indent checkbox">
												<label>
													<input type="checkbox" name="teams[{{homeTeam.id}}][is_captain]" value="1" 
														ng-checked="{{homeTeam.is_captain}}">Captain
												</label>
											</div>
											<div ng-if="m.selectedHomeTeam === homeTeam.id" class="lft-indent checkbox">
												<label>
													<input type="checkbox" name="teams[{{homeTeam.id}}][is_coach]" value="1" 
														ng-checked="{{homeTeam.is_coach}}">Coach
												</label>
											</div><!-- end home team roles -->
										</div><!-- end home team repeat -->
										<div class="checkbox">
												<label class="checkbox-inline no-lft">
													<input type="radio" name="teams" value="-1" 
														ng-model="m.selectedHomeTeam" 
														ng-change="m.enableTeamRoles(-1)"> None
												</label>
											</div>
									</div><!-- end home teams -->

									<!-- <div class="col-lg-6" 
										ng-if="m.memberLevel && 
											(m.memberLevel === 'Level 4' || m.memberLevel === 'Level 5' || m.memberLevel === 'Level 6')"> -->
									<div class="col-lg-6" ng-if="m.memberType === 'Skater'">
										<label class="block">Travel Teams</label>

										<div ng-repeat="travelTeam in m.travelTeams">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="teams[{{travelTeam.id}}][id]" 
														value="{{travelTeam.id}}" 
														ng-model="travelTeam.checked" 
														ng-checked="travelTeam.checked" 
														ng-change="m.enableTTRoles(travelTeam.id);"> {{travelTeam.name}}
												</label>
											</div>
											<div ng-if="m.seletedTravelTeams.indexOf(travelTeam.id) > -1" class="lft-indent checkbox">
												<label>
													<input type="checkbox" name="teams[{{travelTeam.id}}][is_captain]" 
														value="1" ng-checked="{{travelTeam.is_captain}}">Captain
												</label>
											</div>
											<div ng-if="m.seletedTravelTeams.indexOf(travelTeam.id) > -1" class="lft-indent checkbox">
												<label>
													<input type="checkbox" name="teams[{{travelTeam.id}}][is_coach]" 
														value="1" ng-checked="{{travelTeam.is_coach}}">Coach
												</label>
											</div><!-- end travel team roles -->
										</div><!-- end travel team repeat -->
									</div><!-- end travel teams -->
								</div><!-- /.col-lg-6 teams -->
							</div><!-- /.row hr/t&r specifics -->

							<div class="row">
							<hr />
								<div class="col-lg-8">
									<h5>{{m.today | date:'yyyy'}} {{m.reqsType}} Requirements <i class="fa fa-th-large fa-fw"></i>
										<button type="button" class="btn btn-default btn-inline" 
											ng-show="m.action === 'update'"
											ng-class="{'btn-primary selected': m.showRecentClockIns}" 
											ng-click="m.toggleRecentClockins()">
												View<span ng-show="m.showRecentClockIns">ing</span> Recent Clock-ins
										</button>
									</h5>

									<p><strong>Remaining</strong>: number member needs to attend | <strong>Count</strong>: number member has attended</p>

									<div class="requirements-table">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>Req. Type</th>
													<th class="center">Q1 reqs</th>
													<th class="center">Q1 rem. / count</th>
													<th class="center">Q2 reqs</th>
													<th class="center">Q2 rem. / count</th>
													<th class="center">Q3 reqs</th>
													<th class="center">Q3 rem. / count</th>
													<th class="center">Q4 reqs</th>
													<th class="center">Q4 rem. / count</th>
												</tr>
											</thead>
											<tbody>
												<tr ng-repeat="reqH in m.reqHeaders" ng-class-even="'even'" ng-class-odd="'odd'">
													<td>{{reqH | capitalize}}</td>
													<td class="center" ng-repeat="req in m.currentReqs[reqH]">
														<span ng-if="req.type === 'base'">{{req.count}}</span>
														<input type="text" class="xsm"
															name="user_requirements[{{reqH}}][{{req.quarter}}][amended]"
															ng-disabled="req.quarter != m.currentQuarter"
															ng-if="req.type === 'base'"
															ng-model="m.watchReqs[reqH][req.quarter].amended"
															ng-change="m.updateReqs(req.quarter, reqH)" />
														<span class="no-top" ng-if="req.type === 'remaining'">
															<span 
																ng-bind="m.watchReqs[reqH][req.quarter].remaining" 
																ng-class="{'warning': m.watchReqs[reqH][req.quarter].remaining > 0}">
															</span> / {{req.attended}}
														</span>
														<input type="hidden" ng-if="req.type === 'base'" 
															name="user_requirements[{{reqH}}][{{req.quarter}}][id]" value="{{req.id}}" />
														<input type="hidden" ng-if="req.type === 'base'" 
															name="user_requirements[{{reqH}}][{{req.quarter}}][remaining]" value="{{m.watchReqs[reqH][req.quarter].remaining}}" />
													</td>
												</tr>
											</tbody>
										</table>
									</div><!-- /.requirements-table -->
								</div>

								<div class="form-group col-lg-4">
									<h5>Skater Requirements per Dues</h5>
									<p ng-if="m.memberLevel"><strong>Skater Level:</strong> {{m.memberLevel}}</p>

									<p>Show requirements based on payments!</p>

									<p>If level 5 and last pay was $50:</p>

									<p ng-if="m.memberLevel === 'Level 1'">No requirements</p>


									<p ng-if="m.memberLevel === 'Level 2'">
										Pick 1 (Committee, Activity, Bout)<br />
										(last paid $50 OR qtr paid was 45*3 OR yr paid was $40*12)
									</p>
									<p ng-if="m.memberLevel === 'Level 2'">
										None<br />
										(last paid $85 OR qtr paid was $80*3 OR yr paid was $75*12)
									</p>


									<p ng-if="m.memberLevel === 'Level 3'">
										2 Credits between Activity and Bout (or Committee)<br />
										(last paid $50 OR qtr paid was 45*3 OR yr paid was $40*12)
									</p>
									<p ng-if="m.memberLevel === 'Level 3'">
										1 Credit between Activity and Bout (or Committee)<br />
										(last paid $85 OR qtr paid was $80*3 OR yr paid was $75*12)
									</p>
									<p ng-if="m.memberLevel === 'Level 3'">
										None<br />
										(last paid $120 OR qtr paid was $115*3 OR yr paid was $110*12)
									</p>


									<p ng-if="m.memberLevel === 'Level 4'">
										3 Credits between Activity and Bout (or 1 Credit and Committee)<br />
										(last paid $50 OR qtr paid was 45*3 OR yr paid was $40*12)
									</p>
									<p ng-if="m.memberLevel === 'Level 4'">
										2 Credits between Activity and Bout (or Committee)<br />
										(last paid $85 OR qtr paid was $80*3 OR yr paid was $75*12)
									</p>
									<p ng-if="m.memberLevel === 'Level 4'">
										1 Credit between Activity and Bout (or Committee)<br />
										(last paid $120 OR qtr paid was $115*3 OR yr paid was $110*12)
									</p>
									<p ng-if="m.memberLevel === 'Level 4'">
										None<br />
										(last paid $150 OR qtr paid was $145*3 OR yr paid was $140*12)
									</p>

									<p ng-if="m.memberLevel === 'Level 5' || m.memberLevel === 'Level 6'">
										Committee, Activity, Bout, &amp; Practice/Scrimmage<br />
										(last paid $50 OR qtr paid was 45*3 OR yr paid was $40*12)
									</p>
									<p ng-if="m.memberLevel === 'Level 5' || m.memberLevel === 'Level 6'">
										Committee, Activity OR Bout, &amp; Practice/Scrimmage<br />
										(last paid $85 OR qtr paid was $80*3 OR yr paid was $75*12)
									</p>
									<p ng-if="m.memberLevel === 'Level 5' || m.memberLevel === 'Level 6'">
										Committee &amp; Practice/Scrimmage<br />
										(last paid $120 OR qtr paid was $115*3 OR yr paid was $110*12)
									</p>
									<p ng-if="m.memberLevel === 'Level 5' || m.memberLevel === 'Level 6'">
										Practice/Scrimmage<br />
										(last paid $185 OR qtr paid was $180*3 OR yr paid was $175*12)
									</p>

								</div>
								<!-- /disabled -->
							</div>
							<!-- /.row requirements -->

							<div class="row">
								<div class="col-lg-12">
									<button class="btn btn-default">Back to Member Manager</button>
									<button class="btn btn-default" type="submit">
										<span ng-show="m.action === 'create'">Save New Member Information</span>
										<span ng-show="m.action === 'update'">Save &amp; Update Member Information</span>
									</button>
								</div>
							</div>


						</div>
						<!-- /.col-lg-12 -->
					</div>
					<!-- /.row form -->

				</form>
			</div>
			<!-- /#page-wrapper -->

		</div>
	</div>
	<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
@endsection
