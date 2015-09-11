@extends('app')

@section('content')
<div id="wrapper" ng-controller="Member as m" ng-class="{'toggled' : m.hideMemberSidebar}">

	<!-- Sidebar -->
	<div id="sidebar-wrapper">
		
		<div ng-if="m.showTransactions" class="member-sidebar transactions">
			<h3>Financial Information</h3>

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
				<label class="block">Venmo Transactions: Payments &amp; Charges</label>
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
						<tr style="background-color:#c00 !important;">
							<td><i class="fa fa-plus"></i></td>
							<td>August Dues</td>
							<td>$60</td>
							<td>8/14/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td><i class="fa fa-minus"></i></td>
							<td>MHC NY Stipend</td>
							<td>$250</td>
							<td>5/3/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td><i class="fa fa-plus"></i></td>
							<td>Qtr 2 Dues</td>
							<td>$140</td>
							<td>5/3/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td><i class="fa fa-plus"></i></td>
							<td>April Dues</td>
							<td>$50</td>
							<td>4/3/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td><i class="fa fa-plus"></i></td>
							<td>Crushers Jersey</td>
							<td>$30</td>
							<td>2/3/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr style="background-color:#c00 !important;">
							<td><i class="fa fa-plus"></i></td>
							<td>August Dues</td>
							<td>$60</td>
							<td>8/14/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td><i class="fa fa-minus"></i></td>
							<td>MHC NY Stipend</td>
							<td>$250</td>
							<td>5/3/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td><i class="fa fa-plus"></i></td>
							<td>Qtr 2 Dues</td>
							<td>$140</td>
							<td>5/3/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td><i class="fa fa-plus"></i></td>
							<td>April Dues</td>
							<td>$50</td>
							<td>4/3/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td><i class="fa fa-plus"></i></td>
							<td>Crushers Jersey</td>
							<td>$30</td>
							<td>2/3/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr style="background-color:#c00 !important;">
							<td><i class="fa fa-plus"></i></td>
							<td>August Dues</td>
							<td>$60</td>
							<td>8/14/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td><i class="fa fa-minus"></i></td>
							<td>MHC NY Stipend</td>
							<td>$250</td>
							<td>5/3/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td><i class="fa fa-plus"></i></td>
							<td>Qtr 2 Dues</td>
							<td>$140</td>
							<td>5/3/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td><i class="fa fa-plus"></i></td>
							<td>April Dues</td>
							<td>$50</td>
							<td>4/3/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td><i class="fa fa-plus"></i></td>
							<td>Crushers Jersey</td>
							<td>$30</td>
							<td>2/3/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
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

			<button class="btn btn-default">View Transaction History</button>

			<br clear="all" />

		</div><!-- /.member-sidebar -->

		<div ng-if="m.showPracticeHistory" class="member-sidebar practice-history">
			<h3>Recent Clock-ins</h3>
			<p>Red background indicates late clock-in</p>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Q</th>
							<th>Type</th>
							<th>Title</th>
							<th>Date</th>
							<th>&nbps;</th>
						</tr>
					</thead>
					<tbody>
						<tr style="background-color:#c00 !important;">
							<td>2</td>
							<td>Practice</td>
							<td>MHC</td>
							<td>5/23/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td>2</td>
							<td>Scrimmage</td>
							<td>BW v MHC</td>
							<td>5/21/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td>2</td>
							<td>Practice</td>
							<td>Bruising</td>
							<td>6/1/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						 <tr>
						 <td>3</td>
							<td>Scrimmage</td>
							<td>BW v MHC</td>
							<td>5/21/15</td>
							<td class="center"><i class="fa fa-times"></i></td>
						</tr>
						<tr>
							<td>3</td>
							<td>Practice</td>
							<td>Bruising</td>
							<td>6/1/15</td>
							<td class="center"><i class="fa fa-times"></i></td>
						</tr>
						<tr style="background-color:#c00 !important;">
						<td>3</td>
								<td>Practice</td>
								<td>MHC</td>
								<td>5/23/15</td>
								<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td>4</td>
							<td>Practice</td>
							<td>Bruising</td>
							<td>6/1/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td>4</td>
							<td>Scrimmage</td>
							<td>BW v MHC</td>
							<td>5/21/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td>4</td>
							<td>Practice</td>
							<td>Bruising</td>
							<td>6/1/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td>4</td>
							<td>Practice</td>
							<td>Bruising</td>
							<td>6/1/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td>4</td>
							<td>Scrimmage</td>
							<td>BW v MHC</td>
							<td>5/21/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td>1</td>
							<td>Practice</td>
							<td>Bruising</td>
							<td>6/1/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td>1</td>
							<td>Practice</td>
							<td>Bruising</td>
							<td>6/1/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td>1</td>
							<td>Scrimmage</td>
							<td>BW v MHC</td>
							<td>5/21/15</td>
							<td class="center"><i class="fa fa-check"></i></td>
						</tr>
						<tr>
							<td>1</td>
							<td>Practice</td>
							<td>Bruising</td>
							<td>6/1/15</td><td class="center"><i class="fa fa-check"></i></td>
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

				<div id="top-wrapper" style="border:1px solid green;">
					do something
				</div>

				<form role="form">



					<div class="row">
						<div class="col-lg-12">
							<button class="btn btn-default">Back to Member Manager</button>
							<button class="btn btn-default">Save &amp; Update Member Information</button>
							<strong>&nbsp;&nbsp;|&nbsp;&nbsp;</strong>
							<button class="btn btn-default">View Transaction History</button>
							<button class="btn btn-default">View Clock-In History</button>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<h2 class="page-header">Member: Stacie Wilhelm (Midge Mayhem)
								<!-- <button class="btn btn-default" ng-click="m.toggleMemberSidebar()">View Financial &amp; Account Information</button> -->
							</h2>
						</div>
					</div>

					<br />

					<div class="row">
						<div class="col-lg-12">

							<div class="row">
								<div class="col-lg-6">
									<h5>Personal Information</h5>
									<div class="row form-group">
										<div class="col-lg-4">
											<label class="block">First Name</label>
											<div class="clear"></div>
											<input type="text" class="form-control" placeholder="John">
										</div>
										<div class="col-lg-4">
											<label class="block">Last Name</label>
											<div class="clear"></div>
											<input type="text" class="form-control" placeholder="Smith">
										</div>
									</div>
									<div class="clear"></div>

									<div class="row col-date form-group">
										<div class="col-lg-4">
											<label class="block">Phone</label>
											<div class="clear"></div>
											<input type="text" class="form-control" placeholder="(111) 111-1111">
										</div>
										<div class="col-lg-4">
											<div class="datepicker-wrap">
												<label class="block">DOB</label>
												<input type="text" class="form-control half datepicker"
													placeholder="mm/dd/yyyy"
													name="dob"
													ng-model="m.dob"
													datepicker-popup="{{m.format}}"
													datepicker-options="m.dateOptions"
													is-open="m.datepickers.dob" 
													ng-click="m.open($event,'dob')" />
												<span class="input-group-btn">
													<button type="button" class="btn btn-default" ng-click="m.open($event,'dob')">
														<i class="fa fa-calendar"></i>
													</button>
												</span>
											</div><!-- /.datepicker-wrap -->
										</div>
									</div><!-- /.col-date -->

									<div class="form-group">
										<label class="block">Alternate Email</label>
										<input class="form-control half" placeholder="myawesomeemail@gmail.com">
									</div>

									
								</div><!-- /personal information -->

								<div class="col-lg-6">
									<h5>Account Information</h5>

									<div class="row form-group">
										<div class="col-lg-4">
											<label class="block">Account Type</label>
											<select>
												<option>Super</option>
												<option>Admin</option>
												<option>Member</option>
											</select>
										</div>
										
										<div class="col-lg-7">
											<label class="block">Group</label>
											<select>
												<option>HR</option>
												<option>Facilities</option>
												<option>Training &amp; Recruitment</option>
											</select>
										</div>
									</div>

									<div class="row form-group">
										<div class="col-lg-4">
											<label class="block">Clock-in number</label>
											<input class="form-control" placeholder="4-digit number">
										</div>
										<div class="col-lg-4">
											<label class="block">Password</label>
											<input class="form-control" placeholder="8 - 15 characters">
										</div>
										
										<div class="col-lg-4">
											<label class="block">&nbsp;</label>
											<button class="btn btn-default">Send activation email</button>
										</div>
									</div>

									<div class="row form-group">
										<div class="col-lg-12">
											<h5>Payment Information</h5>
										</div>
										<div class="col-lg-7">
											<label class="block">Venmo Handle</label>
											<input class="form-control" ng-change="m.prepend('@')" ng-model="m.venmo_handle" placeholder="@">
										</div>
										<div class="col-lg-4">
											<label class="block">&nbsp;</label>
											<button class="btn btn-default" ng-click="m.toggleMemberSidebar()">View Recent Transactions</button>
										</div>

									</div>

								</div><!-- /account information -->
							</div><!-- /.row personal/league information -->

							<hr />

							<div class="row">
								<div class="col-lg-6">
									<h5>League &amp; Skater Information</h5>

									<div class="row form-group">
										<div class="col-lg-4">
											<label class="block">Skater Name</label>
											<input class="form-control" placeholder="Midge Mayhem">
										</div>
										<div class="col-lg-2">
											<label class="block">Skater #</label>
											<input class="form-control" placeholder="20" ng-disabled="m.member_level === 'Level 1' || m.member_level === 'Level 2'">
										</div>
										<div class="col-lg-6">
											<label class="block">Identifies as</label>
											<label class="checkbox-inline">
												<input type="radio" name="gender" id="Male" value="Male">&nbsp;&nbsp;Male
											</label>
											<label class="checkbox-inline">
												<input type="radio" name="gender" id="Female" value="Female">&nbsp;&nbsp;Female
											</label>
										</div>
									</div>

									<div class="row col-date form-group">
										<div class="datepicker-wrap col-lg-4">
											<label class="block">Induction Date</label>
											<input type="text" class="form-control datepicker"
												placeholder="mm/dd/yyyy"
												name="induction_date"
												ng-model="m.induction_date"
												datepicker-popup="{{m.format}}"
												datepicker-options="m.dateOptions"
												is-open="m.datepickers.induction_date" 
												ng-click="m.open($event,'induction_date')" />
											<span class="input-group-btn">
												<button type="button" class="btn btn-default" ng-click="m.open($event,'induction_date')">
													<i class="fa fa-calendar"></i>
												</button>
											</span>
										</div>
										<div class="datepicker-wrap col-lg-4">
											<label class="block">Join Date</label>
											<input type="text" class="form-control datepicker"
												placeholder="mm/dd/yyyy"
												name="join_date"
												ng-model="m.join_date"
												datepicker-popup="{{m.format}}"
												datepicker-options="m.dateOptions"
												is-open="m.datepickers.join_date" 
												ng-click="m.open($event,'join_date')" />
											<span class="input-group-btn">
												<button type="button" class="btn btn-default" ng-click="m.open($event,'join_date')">
													<i class="fa fa-calendar"></i>
												</button>
											</span>
										</div>
										<div class="col-lg-4">
											<label class="block">WFTDA Insurance #</label>
											<input class="form-control half" placeholder="12345">
										</div>
									</div><!-- /.col-date induction / join -->

									<div class="row form-group">
										<div class="col-lg-6">
											<label class="block">Signed?</label>
											<label class="checkbox-inline">
												<input type="checkbox">DRD Waiver
											</label>
											<label class="checkbox-inline">
												<input type="checkbox">Code of Conduct
											</label>
										</div>
										<div class="col-lg-6">
											<label class="block">Paid?</label>
											<label class="checkbox-inline">
												<input type="checkbox">One-time membership fee
											</label>
										</div>
									</div>

									<div class="row col-date form-group">
										<div class="col-lg-6">
											<label>Transfer? <input type="checkbox" ng-model="m.is_transfer"></label>
											<div class="clear"></div>
											<input ng-if="m.is_transfer" class="form-control" placeholder="Previous League">
										</div>
										<div class="col-lg-6">
											<div ng-if="m.is_transfer" class="datepicker-wrap">
												<label class="block">Transfer Date</label>
												<input type="text" class="form-control datepicker"
													placeholder="mm/dd/yyyy"
													name="transfer_date"
													ng-model="m.transfer_date"
													datepicker-popup="{{m.format}}"
													datepicker-options="m.dateOptions"
													is-open="m.datepickers.transfer_date" 
													ng-click="m.open($event,'transfer_date')" />
												<span class="input-group-btn">
													<button type="button" class="btn btn-default" ng-click="m.open($event,'transfer_date')">
														<i class="fa fa-calendar"></i>
													</button>
												</span>
											</div>
										</div>
									</div><!-- / transfer -->

									<div class="row">
										<div class="form-group col-lg-4">
											<label class="block">Member Status</label>
											<select ng-model="m.member_status">
												<option value="Active">Active</option>
												<option value="Suspended">Suspended</option>
												<option value="Alumni">Alumni</option>
												<option value="Retired">Retired</option>
												<option value="Pending">Pending</option>
											</select>
										</div>

										<div class="form-group" ng-if="m.member_status === 'Active'">
										<label class="block">&nbsp;</label>
											<label class="checkbox-inline">
												<input type="checkbox">GD Access?
											</label>
										</div>

										<div class="form-group datepicker-wrap" ng-if="m.member_status === 'Retired'">
											<label class="block">Retirement Date</label>
											<input type="text" class="form-control datepicker"
												placeholder="mm/dd/yyyy"
												name="retirement_date"
												ng-model="m.retirement_date"
												datepicker-popup="{{m.format}}"
												datepicker-options="m.dateOptions"
												is-open="m.datepickers.retirement_date" 
												ng-click="m.open($event,'retirement_date')" />
											<span class="input-group-btn">
												<button type="button" class="btn btn-default" ng-click="m.open($event,'retirement_date')">
													<i class="fa fa-calendar"></i>
												</button>
											</span>
										</div>
									</div><!-- / member status row -->

									<div class="row form-group">
										<div class="col-lg-4">
											<label class="block">Member Type</label>
											<select ng-model="m.member_type">
												<option value="">Choose One...</option>
												<option value="Skater">Skater</option>
												<option value="Associate">Associate</option>
												<option value="Volunteer">Volunteer</option>
											</select>
										</div>

										<div class="col-lg-4" ng-if="m.member_type === 'Skater'">
											<label class="block">Skater Level</label>
											<select>
												<option value="">Choose One...</option>
												<option value="Flight School">Flight School</option>
												<option value="B">B</option>
												<option value="A-">A-</option>
												<option value="A">A</option>
											</select>
										</div>

										<div class="col-lg-4" ng-if="m.member_type === 'Skater'">
											<label class="block">Member Level</label>
											<select name="member_level" ng-model="m.member_level">
												<option value="">Choose One...</option>
												<option value="Level 1">Level 1</option>
												<option value="Level 2">Level 2</option>
												<option value="Level 3">Level 3</option>
												<option value="Level 4">Level 4</option>
												<option value="Level 5">Level 5</option>
												<option value="Level 6">Level 6</option>
											</select>
										</div>
									</div><!-- / member type row -->

								</div><!-- /.col-lg-6 -->
								
								<div class="col-lg-6">
									<h5>HR Specifics</h5>

									<div class="row form-group col-lg-10">
										<label>On Warning?
											<input type="checkbox" ng-model="m.on_warning">
											<span class="inline-date" ng-if="m.on_warning">Starting: {{m.today | date:'dd/MM/yyyy'}}</span>
											<span class="inline-date" ng-if="m.on_warning">Ending: {{m.today | date:'dd/MM/yyyy'}}</span>
										</label>
										<div class="clear"></div>
										<textarea class="notes form-control" placeholder="Warning Notes"></textarea>
									</div><!-- end warning -->

									<div class="row form-group col-lg-10">
										<label>On LOA?
											<input type="checkbox" ng-model="m.on_loa">
											<span class="inline-date" ng-if="m.on_loa">Starting: {{m.today | date:'dd/MM/yyyy'}}</span>
											<span class="inline-date" ng-if="m.on_loa">Ending: {{m.today | date:'dd/MM/yyyy'}}</span>
										</label>
										<div class="clear"></div>
										<textarea class="notes form-control" placeholder="LOA Notes"></textarea>
									</div><!-- end loa -->

									<div class="row form-group col-lg-10">
										<label>On Injury?
											<input type="checkbox" ng-model="m.on_injury">
											<span class="inline-date" ng-if="m.on_injury">Starting: {{m.today | date:'dd/MM/yyyy'}}</span>
											<span class="inline-date" ng-if="m.on_injury">Ending: {{m.today | date:'dd/MM/yyyy'}}</span>
										</label>
										<div class="clear"></div>
										<textarea class="notes form-control" placeholder="Injury Notes"></textarea>
									</div><!-- end injury -->

									<div class="row form-group col-lg-12" ng-if="m.member_type !== 'Volunteer'">

										<p ng-if="m.member_type === 'Associate'">Associate Monthly dues are $15</p>

										<div ng-if="(m.member_type === 'Skater') && m.member_level">
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

													<tr ng-if="m.member_level !== 'Level 1'" class="gradeX">
														<td>$75</td>
														<td>$80</td>
														<td>$85</td>
													</tr>

													<tr ng-if="m.member_level !== 'Level 1' && m.member_level !== 'Level 2'" class="gradeX">
														<td>$110</td>
														<td>$115</td>
														<td>$120</td>
													</tr>

													<tr ng-if="m.member_level === 'Level 4'" class="gradeX">
														<td>$140</td>
														<td>$145</td>
														<td>$150</td>
													</tr>

													<tr ng-if="m.member_level === 'Level 5' || m.member_level === 'Level 6'" class="gradeX">
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
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">HR
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">Facilities
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">IT
												</label>
											</div>
											
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">Marketing
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">BOD
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">Events
												</label>
											</div>
										</div><!-- / end committees -->
										<div class="col-lg-4">
											<label class="block">&nbsp;</label>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">Sponsorship
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">Games/BPC
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">Scheduler
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">Merch
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">Ticketing
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">Training/Recruitment
												</label>
											</div>
										</div><!-- / end committees 2 -->
										<div class="col-lg-4">
											<label class="block">Roles</label>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">Coach
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">Announcer
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">Official: Ref
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">Official: NSO
												</label>
											</div>
										</div><!-- / end roles -->
									</div><!-- / end committees row -->

								</div><!-- /.col-lg-6 committees & roles -->

								<div class="col-lg-6">
									<div class="col-lg-6" ng-if="m.member_level === 'Level 5' || m.member_level === 'Level 6'">
										<label class="block">Home Teams</label>
										<div class="checkbox">
											<label>
												<input type="checkbox" value="">Orange Crushers
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" value="">Shotgun Betties
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" value="">Bad Apples
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" value="">Green Barettes
											</label>
										</div>

										<hr class="clear"/>
										<div class="checkbox">
											<label>
												<input type="checkbox" value="">Coach
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" value="">Captain
											</label>
										</div><!-- end home team roles -->
									</div><!-- end home teams -->

									<div class="col-lg-6" ng-if="m.member_level && (m.member_level === 'Level 4' || m.member_level === 'Level 5' || m.member_level === 'Level 6')">
										<label class="block">Travel Teams</label>
										<div class="checkbox">
											<label>
												<input type="checkbox" value="" ng-disabled="m.member_level === 'Level 4'">Mile High Club
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" value="" ng-disabled="m.member_level === 'Level 4'">Bruising Altitude
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" value="">Standbys
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" value="" ng-disabled="m.member_level === 'Level 4'">MRDA Ground Control
											</label>
										</div>

										<hr class="clear"/>
										<div class="checkbox">
											<label>
												<input type="checkbox" value="">Coach
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" value="">Captain
											</label>
										</div><!-- end travel team roles -->
									</div><!-- end travel teams -->
								</div><!-- /.col-lg-6 teams -->
							</div><!-- /.row hr/t&r specifics -->


							<div class="row">
							<hr />
								<div class="col-lg-8">
									<h5>{{m.today | date:'yyyy'}} Minimum Requirements
										<button class="btn btn-default" ng-click="m.practiceHistory()">View Recent Clock-ins</button>
									</h5>
									<div class="requirements-table">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>Req. Type</th>
													<th class="center">Q1 current</th>
													<th class="center">Q1 remaining</th>
													<th class="center">Q2 current</th>
													<th class="center">Q2 remaining</th>
													<th class="center">Q3 current</th>
													<th class="center">Q3 remaining</th>
													<th class="center">Q4 current</th>
													<th class="center">Q4 remaining</th>
												</tr>
											</thead>
											<tbody>
												<tr class="odd gradeX">
													<td>Practice</td>
													<td class="center">23</td>
													<td><span>12</span> <input type="text" class="xsm" /></td>
													<td class="center">1</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
													<td class="center">1</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
													<td class="center">1</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
												</tr>
												<tr class="even gradeC">
													<td>Scrimmage</td>
													<td class="center">12</td>
													<td><span>7</span> <input type="text" class="xsm" /></td>
													<td class="center">12</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
													<td class="center">12</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
													<td class="center">6</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
												</tr>
												<tr class="odd gradeA">
													<td>Bout</td>
													<td class="center">0</td>
													<td><span>1</span> <input type="text" class="xsm" /></td>
													<td class="center">1</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
													<td class="center">1</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
													<td class="center">1</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
												</tr>
												<tr class="odd gradeA">
													<td>Committee</td>
													<td class="center">0</td>
													<td><span>1</span> <input type="text" class="xsm" /></td>
													<td class="center">1</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
													<td class="center">1</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
													<td class="center">1</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
												</tr>
												<tr class="even gradeA">
													<td>Activity</td>
													<td class="center">1</td>
													<td><span>0</span> <input type="text" class="xsm" /></td>
													<td class="center">1</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
													<td class="center">1</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
													<td class="center">1</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
												</tr>
												<tr class="odd gradeA">
													<td>Facility</td>
													<td class="center">0</td>
													<td><span>1</span> <input type="text" class="xsm" /></td>
													<td class="center">1</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
													<td class="center">1</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
													<td class="center">1</td>
													<td><input type="text" disabled="disabled" class="xsm" /></td>
												</tr>
											</tbody>
										</table>
									</div><!-- /.requirements-table -->
								</div>

								<div class="form-group col-lg-4">
									<h5>Skater Requirements per Dues</h5>
									<p ng-if="m.member_level"><strong>Skater Level:</strong> {{m.member_level}}</p>

									<p>Show requirements based on payments!</p>

									<p>If level 5 and last pay was $50:</p>

									<p ng-if="m.member_level === 'Level 1'">No requirements</p>


									<p ng-if="m.member_level === 'Level 2'">
										Pick 1 (Committee, Activity, Bout)<br />
										(last paid $50 OR qtr paid was 45*3 OR yr paid was $40*12)
									</p>
									<p ng-if="m.member_level === 'Level 2'">
										None<br />
										(last paid $85 OR qtr paid was $80*3 OR yr paid was $75*12)
									</p>


									<p ng-if="m.member_level === 'Level 3'">
										2 Credits between Activity and Bout (or Committee)<br />
										(last paid $50 OR qtr paid was 45*3 OR yr paid was $40*12)
									</p>
									<p ng-if="m.member_level === 'Level 3'">
										1 Credit between Activity and Bout (or Committee)<br />
										(last paid $85 OR qtr paid was $80*3 OR yr paid was $75*12)
									</p>
									<p ng-if="m.member_level === 'Level 3'">
										None<br />
										(last paid $120 OR qtr paid was $115*3 OR yr paid was $110*12)
									</p>


									<p ng-if="m.member_level === 'Level 4'">
										3 Credits between Activity and Bout (or 1 Credit and Committee)<br />
										(last paid $50 OR qtr paid was 45*3 OR yr paid was $40*12)
									</p>
									<p ng-if="m.member_level === 'Level 4'">
										2 Credits between Activity and Bout (or Committee)<br />
										(last paid $85 OR qtr paid was $80*3 OR yr paid was $75*12)
									</p>
									<p ng-if="m.member_level === 'Level 4'">
										1 Credit between Activity and Bout (or Committee)<br />
										(last paid $120 OR qtr paid was $115*3 OR yr paid was $110*12)
									</p>
									<p ng-if="m.member_level === 'Level 4'">
										None<br />
										(last paid $150 OR qtr paid was $145*3 OR yr paid was $140*12)
									</p>


									<p ng-if="m.member_level === 'Level 5' || m.member_level === 'Level 6'">
										Committee, Activity, Bout, &amp; Practice/Scrimmage<br />
										(last paid $50 OR qtr paid was 45*3 OR yr paid was $40*12)
									</p>
									<p ng-if="m.member_level === 'Level 5' || m.member_level === 'Level 6'">
										Committee, Activity OR Bout, &amp; Practice/Scrimmage<br />
										(last paid $85 OR qtr paid was $80*3 OR yr paid was $75*12)
									</p>
									<p ng-if="m.member_level === 'Level 5' || m.member_level === 'Level 6'">
										Committee &amp; Practice/Scrimmage<br />
										(last paid $120 OR qtr paid was $115*3 OR yr paid was $110*12)
									</p>
									<p ng-if="m.member_level === 'Level 5' || m.member_level === 'Level 6'">
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
									<button class="btn btn-default">Save &amp; Update Member Information</button>
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


