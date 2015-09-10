@extends('app')

@section('content')
<div id="wrapper" ng-controller="Member as m" ng-class="{'toggled' : m.hideMemberSidebar}">
	<!-- Sidebar -->
	<div id="sidebar-wrapper">
		
		<div ng-if="m.showTransactions" class="member-sidebar transactions">
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
			</div>

			<button class="btn btn-default">See previous transactions</button>

			<br clear="all" />
			<hr />

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
                  <tr style="background-color:#c00 !important;">
                      <td>2</td>
                      <td>Practice</td>
                      <td>MHC</td>
                      <td>5/23/15</td>
                  </tr>
                  <tr>
                      <td>2</td>
                      <td>Scrimmage</td>
                      <td>BW v MHC</td>
                      <td>5/21/15</td>
                  </tr>
                  <tr>
                  <td>2</td>
                      <td>Practice</td>
                      <td>Bruising</td>
                      <td>6/1/15</td>
                  </tr>
                   <tr>
                   <td>3</td>
                      <td>Scrimmage</td>
                      <td>BW v MHC</td>
                      <td>5/21/15</td>
                  </tr>
                  <tr>
                  <td>3</td>
                      <td>Practice</td>
                      <td>Bruising</td>
                      <td>6/1/15</td>
                  </tr>
                  <tr style="background-color:#c00 !important;">
                  <td>3</td>
                      <td>Practice</td>
                      <td>MHC</td>
                      <td>5/23/15</td>
                  </tr>
                  <tr>
                  <td>4</td>
                      <td>Practice</td>
                      <td>Bruising</td>
                      <td>6/1/15</td>
                  </tr>
                   <tr>
                   <td>4</td>
                      <td>Scrimmage</td>
                      <td>BW v MHC</td>
                      <td>5/21/15</td>
                  </tr>
                  <tr>
                  <td>4</td>
                      <td>Practice</td>
                      <td>Bruising</td>
                      <td>6/1/15</td>
                  </tr>
                  <tr>
                  <td>4</td>
                      <td>Practice</td>
                      <td>Bruising</td>
                      <td>6/1/15</td>
                  </tr>
                   <tr>
                   <td>4</td>
                      <td>Scrimmage</td>
                      <td>BW v MHC</td>
                      <td>5/21/15</td>
                  </tr>
                  <tr>
                  <td>1</td>
                      <td>Practice</td>
                      <td>Bruising</td>
                      <td>6/1/15</td>
                  </tr>
                  <tr>
                  <td>1</td>
                      <td>Practice</td>
                      <td>Bruising</td>
                      <td>6/1/15</td>
                  </tr>
                   <tr>
                   <td>1</td>
                      <td>Scrimmage</td>
                      <td>BW v MHC</td>
                      <td>5/21/15</td>
                  </tr>
                  <tr>
                  <td>1</td>
                      <td>Practice</td>
                      <td>Bruising</td>
                      <td>6/1/15</td>
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
				<form role="form">

					<div class="row">
						<div class="col-lg-12">
							<button class="btn btn-default">Back to Member Manager</button>
							<button class="btn btn-default">Update Member Information</button>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<h2 class="page-header">Member Account: Stacie Wilhelm (Midge Mayhem) [static]
								<button class="btn btn-default" ng-click="m.toggleMemberSidebar()">View Financial &amp; Account Information</button>
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
										<div class="col-lg-6">
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
											</div>
										</div>
									</div><!-- /.col-date -->

									<div class="form-group">
										<input class="form-control half" placeholder="Alternate Email">
									</div>

									<div class="form-group">
										<label class="block">Venmo Handle</label>
										<input class="form-control half" ng-change="m.prepend('@')" ng-model="m.venmo_handle" placeholder="@">
									</div>
								</div>
								<!-- /personal information -->

								<div class="col-lg-6">
									<h5>League Information</h5>

									<div class="row col-date form-group">
										<div class="datepicker-wrap col-lg-6">
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
										<div class="datepicker-wrap col-lg-6">
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
									</div><!-- /.col-date -->

									<div class="form-group">
										<label class="block">Signed?</label>
										<label class="checkbox-inline">
											<input type="checkbox">DRD Waiver
										</label>
										<label class="checkbox-inline">
											<input type="checkbox">Code of Conduct
										</label>
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
									</div>

									<div class="row form-group col-lg-4">
										<label class="block">Member Type</label>
										<select ng-model="m.member_type">
											<option value="">Choose One...</option>
											<option value="Skater">Skater</option>
											<option value="Associate">Associate</option>
											<option value="Volunteer">Volunteer</option>
										</select>
									</div>

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

								</div>
								<!-- /league information -->

							</div>
							<!-- /.row personal/league information -->

							<div class="row">
								<div class="col-lg-6">
									<div class="form-group col-lg-6">
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
								            <input type="checkbox" value="">Training &amp; Recruitment
								        </label>
								    </div>
								    <div class="checkbox">
							        <label>
							            <input type="checkbox" value="">Marketing
							        </label>
								    </div>
								    <div class="checkbox">
								        <label>
								            <input type="checkbox" value="">Merch
								        </label>
								    </div>
								    
								    <div class="checkbox">
								        <label>
								            <input type="checkbox" value="">BOD
								        </label>
								    </div>
								    <div class="checkbox">
								        <label>
								            <input type="checkbox" value="">Juniors
								        </label>
								    </div>
									</div><!-- end committees -->

									<div class="form-group col-lg-6">
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
									</div><!-- end roles -->
								</div><!-- /committees / roles -->
								
								<div class="col-lg-6">
									<!-- <div ng-if="m.member_type === 'Skater'"> -->
									<div>
										<h5>Skater Information</h5>
										<div class="row form-group">
											<div class="col-lg-4">
												<label class="block">Skater Name</label>
												<input class="form-control" placeholder="Midge Mayhem">
											</div>
											<div class="col-lg-2">
												<label class="block">Skater #</label>
												<input class="form-control" placeholder="20">
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

										<div class="row form-group">
											<div class="col-lg-4">
												<label class="block">WFTDA Insurance #</label>
												<input class="form-control half" placeholder="12345">
											</div>
											<div class="col-lg-4">
												<label class="block">Skater Level</label>
												<select>
													<option>Flight School</option>
													<option>B</option>
													<option>A-</option>
													<option>A</option>
												</select>
											</div>
											<!-- <label>Is Paid for? <input type="checkbox" ng-model="m.insurance_paid"></label>
											<label class="block">Paid for</label>
											<select>
												<option>Year</option>
												<option>2015</option>
												<option>2014</option>
											</select> -->

										</div>
										
										<div class="clear"></div>
										
										<div class="row form-group">

											<div class="col-lg-4">
												<label class="block">Member Level</label>
												<select>
													<option>Level 1</option>
													<option>Level 2</option>
													<option>Level 3</option>
													<option>Level 4</option>
													<option>Level 5</option>
												</select>
											</div>
											
											<div class="col-lg-4">
												<label class="block">Dues</label>
												<select>
													<option>Skater</option>
													<option>Associate</option>
													<option>Volunteer</option>
												</select>
											</div>
										</div><!-- /.row skater info -->

									</div><!-- /ng-if -->
								</div><!-- /.col-lg-6 -->
							</div><!-- /.row committees / skater information -->










							


							<!-- <div class="row" class="col-lg-12">
								<div class="col-lg-12">
									<h2>Skater Information</h2>
								</div>
									
								<div class="col-lg-6">

									<div class="form-group col-lg-4">
										<label class="block">Member Status</label>
										<select>
											<option>Active</option>
											<option>Suspended</option>
											<option>Alumni</option>
											<option>Retired</option>
											<option>Pending</option>
										</select>
									</div>

									<div class="form-group col-lg-4">
										<label class="block">Member Type</label>
										<select ng-model="m.member_type">
											<option value="">Choose One...</option>
											<option value="Skater">Skater</option>
											<option value="Associate">Associate</option>
											<option value="Volunteer">Volunteer</option>
										</select>
									</div>


							</div> -->

							<div class="row">
								<!-- <div class="col-lg-12">
									<h2>Skater Information</h2>
								</div>
									
								<div class="col-lg-6">

									<div class="form-group col-lg-4">
										<label class="block">Member Status</label>
										<select>
											<option>Active</option>
											<option>Suspended</option>
											<option>Alumni</option>
											<option>Retired</option>
											<option>Pending</option>
										</select>
									</div>

									<div class="form-group col-lg-4">
										<label class="block">Member Type</label>
										<select ng-model="m.member_type">
											<option value="">Choose One...</option>
											<option value="Skater">Skater</option>
											<option value="Associate">Associate</option>
											<option value="Volunteer">Volunteer</option>
										</select>
									</div>

									







								</div> -->
								<!-- /end col-6 -->

								<div class="col-lg-6">
									
									


									<div class="form-group">
										
										<!-- <label class="block">Allowed Practices</label>
										<div class="col-lg-4">
											<div class="checkbox">
										    <label>
										        <input type="checkbox" value="">Bruising
										    </label>
										  </div>
										  <div class="checkbox">
										      <label>
										          <input type="checkbox" value="">Flight School
										      </label>
										  </div>
										  <div class="checkbox">
										      <label>
										          <input type="checkbox" value="">MHC
										      </label>
										  </div>
										  <div class="checkbox">
										      <label>
										          <input type="checkbox" value="">Ground Control
										      </label>
										  </div>
										</div> -->
									</div>

								</div>


								<!-- /league information -->

								<hr class="clear" />

								<div class="col-lg-12">

									

									<div class="form-group col-lg-3">
										<div class="col-lg-7">
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
										</div><!-- end home teams -->
								    <div class="form-group col-lg-5">
								    	<label class="block">&nbsp;</label>
								    	<div class="checkbox">
								        <label>
								            <input type="checkbox" value="">Coach
								        </label>
									    </div>
									    <div class="checkbox">
									        <label>
									            <input type="checkbox" value="">Captain
									        </label>
									    </div>
								    </div><!-- end home teams roles -->
									</div><!-- end all home teams -->

									<div class="form-group col-lg-3">
										<div class="col-lg-7">
											<label class="block">Travel Teams</label>
								    	<div class="checkbox">
								        <label>
								            <input type="checkbox" value="">Mile High Club
								        </label>
									    </div>
									    <div class="checkbox">
									        <label>
									            <input type="checkbox" value="">Bruising Altitude
									        </label>
									    </div>
									    <div class="checkbox">
									        <label>
									            <input type="checkbox" value="">Standbys
									        </label>
									    </div>
									    <div class="checkbox">
									        <label>
									            <input type="checkbox" value="">MRDA Ground Control
									        </label>
									    </div>
										</div><!-- end travel teams -->
								    <div class="form-group col-lg-5">
								    	<label class="block">&nbsp;</label>
								    	<div class="checkbox">
								        <label>
								            <input type="checkbox" value="">Coach
								        </label>
									    </div>
									    <div class="checkbox">
									        <label>
									            <input type="checkbox" value="">Captain
									        </label>
									    </div>
								    </div><!-- end travel team roles -->
									</div><!-- end all travel teams -->

								</div>
								<!-- /col-lg-12 committees / roles / home teams / travel teams -->
							</div>
							<!-- /.row form league information -->

							<div class="row">
								<div class="col-lg-8">
									<h2>2015 Requirements</h2>
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
												    <td>Practices</td>
												    <td>23</td>
												    <td>12 <input type="text" class="xsm" /></td>
												    <td>n/a</td>
												    <td>n/a <input type="text" disabled="disabled" class="xsm" /></td>
												    <td>n/a</td>
												    <td>n/a <input type="text" disabled="disabled" class="xsm" /></td>
												    <td>n/a</td>
												    <td>n/a <input type="text" disabled="disabled" class="xsm" /></td>
												</tr>
												<tr class="even gradeC">
												    <td>Scrimmages</td>
												    <td>12</td>
												    <td>7 <input type="text" class="xsm" /></td>
												    <td>n/a</td>
												    <td>n/a  <input type="text" disabled="disabled" class="xsm" /></td>
												    <td>n/a</td>
												    <td>n/a  <input type="text" disabled="disabled" class="xsm" /></td>
												    <td>n/a</td>
												    <td>n/a  <input type="text" disabled="disabled" class="xsm" /></td>
												</tr>
												<tr class="odd gradeA">
												    <td>Committees</td>
												    <td>0</td>
												    <td>1 <input type="text" class="xsm" /></td>
												    <td>n/a</td>
												    <td>n/a <input type="text" disabled="disabled" class="xsm" /></td>
												    <td>n/a</td>
												    <td>n/a <input type="text" disabled="disabled" class="xsm" /></td>
												    <td>n/a</td>
												    <td>n/a <input type="text" disabled="disabled" class="xsm" /></td>
												</tr>
												<tr class="even gradeA">
												    <td>Activities</td>
												    <td>1</td>
												    <td>0 <input type="text" class="xsm" /></td>
												    <td>n/a</td>
												    <td>n/a <input type="text" disabled="disabled" class="xsm" /></td>
												    <td>n/a</td>
												    <td>n/a <input type="text" disabled="disabled" class="xsm" /></td>
												    <td>n/a</td>
												    <td>n/a <input type="text" disabled="disabled" class="xsm" /></td>
												</tr>
												<tr class="odd gradeA">
												    <td>Facilities</td>
												    <td>0</td>
												    <td>1 <input type="text" class="xsm" /></td>
												    <td>n/a</td>
												    <td>n/a <input type="text" disabled="disabled" class="xsm" /></td>
												    <td>n/a</td>
												    <td>n/a <input type="text" disabled="disabled" class="xsm" /></td>
												    <td>n/a</td>
												    <td>n/a <input type="text" disabled="disabled" class="xsm" /></td>
												</tr>
                      </tbody>
                    </table>
	                </div>
	                <button class="btn btn-default" ng-click="m.practiceHistory()">View practice history &amp; details</button>
								</div>

								<div class="form-group col-lg-4">
									<h2>Other Information</h2>
						    	
						    	<div class="col-lg-12">
						    		<div class="checkbox col-lg-5">
											<label>
											  <input type="checkbox" value="">Warning
											</label>
										</div>
										<div class="form-group">
											<textarea class="form-control" placeholder="Warning Notes"></textarea>
										</div>
						    	</div><!-- end warning -->

									<div class="col-lg-12">
						        <div class="checkbox">
											<label>
											    <input type="checkbox" value="">LOA
											</label>
											<input type="text" placeholder="Start Date" class="form-control sm" />
											<input type="text" placeholder="End Date" class="form-control sm" />
										</div>
						        <div class="form-group">
								    	<textarea class="form-control" placeholder="LOA Notes"></textarea>
								    </div>
							    </div><!-- end loa -->

							    <div class="col-lg-12">
						        <div class="checkbox">
											<label>
											    <input type="checkbox" value="">Injury
											</label>
											<input type="text" placeholder="Start Date" class="form-control sm" />
											<input type="text" placeholder="End Date" class="form-control sm" />
										</div>
						        <div class="form-group">
								    	<textarea class="form-control" placeholder="Notes"></textarea>
								    </div>
							    </div><!-- end injury -->

								</div>
								<!-- /disabled -->
							</div>
							<!-- /.row requirements -->

							<div class="row">
								<div class="col-lg-12">
									<button class="btn btn-default">Back to Member Manager</button>
									<button class="btn btn-default">Update Member Information</button>
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


