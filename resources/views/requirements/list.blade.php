@extends('app')

@section('content')

<!-- Page Content -->
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div id="page-wrapper" 
			class="member-list" 
			ng-controller="RequirementMngr as reqMngr"
			ng-init="reqMngr.setReqData([[$reqs]]);
			reqMngr.setTeamData([[$teams]]);">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">League Requirements</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->

			<div class="row">
				<form class="form-horizontal" role="form" ng-submit="reqMngr.addReq()">

					<div class="row col-lg-8">
						<div class="row form-group">
							<div class="col-lg-4">
								<label class="block">Req. for</label>
								<select name="req_type" ng-model="req_type">
									<option value="">Choose One&hellip;</option>
									<option ng-repeat="type in reqMngr.reqTypes" value="{{type}}">{{type.name}}</option>
								</select>
							</div>

							<div class="col-lg-4">
								<label class="block">Year</label>
								<select name="year" ng-model="year">
									<option value="">Choose One&hellip;</option>
									<option ng-repeat="y in reqMngr.upcomingYrs"
										ng-selected="y.year === reqMngr.currentYear"
										value="{{y.year}}">{{y.year}}</option>
								</select>
							</div>

							<div class="col-lg-4">
								<label class="block">Quarter</label>
								<select name="quarter" ng-model="quarter">
									<option value="">Choose One&hellip;</option>
									<option ng-repeat="qtr in reqMngr.allQuarters"
										ng-selected="qtr === reqMngr.currentQtr"
										value="{{qtr}}">{{qtr}}</option>
								</select>
							</div>

						</div><!-- end row -->
						<div class="row col-lg-8">
							<div class="col-lg-2">
								<label class="block">Practice</label>
								<input type="number" class="form-control" name="practice" ng-model="practice" />
							</div>

							<div class="col-lg-2">
								<label class="block">Scrimmage</label>
								<input type="number" class="form-control" name="scrimmage" ng-model="scrimmage" />
							</div>

							<div class="col-lg-2">
								<label class="block">Activity</label>
								<input type="number" class="form-control" name="activity" ng-model="activity" />
							</div>

							<div class="col-lg-2">
								<label class="block">Committee</label>
								<input type="number" class="form-control" name="committee" ng-model="committee" />
							</div>

							<div class="col-lg-2">
								<label class="block">Facility</label>
								<input type="number" class="form-control" name="facility" ng-model="facility" />
							</div>

							<div class="col-lg-2">
								<label class="block">Bout</label>
								<input type="number" class="form-control" name="bout" ng-model="bout" />
							</div>
						</div>
					</div>
					<div class="row col-lg-4">
						<button type="submit" class="btn btn-primary">Save New Requirement</button>
						<div class="clear"></div>
						<div ng-cloak ng-show="reqMngr.loaded && reqMngr.showSavedNote" class="success-msg">
							<i class="fa fa-check"></i>Saved!
							<!-- <i class="fa fa-warning"></i> -->
						</div>
					</div>

					<div class="clear"></div>
				</form>
				<hr />
			</div><!-- end form row -->

			<div class="loading-spinner" ng-hide="reqMngr.loaded"><span class="fa fa-spinner fa-pulse fa-5x"></span></div>

			<div ng-cloak ng-show="reqMngr.loaded" class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-hover req-table">
							<thead>
								<tr>
									<th class="req-type">Requirement For</th>
									<th class="center">Year</th>
									<th class="center">Quarter</th>
									<th class="center">Practice</th>
									<th class="center">Scrimmage</th>
									<th class="center">Activity</th>
									<th class="center">Committee</th>
									<th class="center">Facility</th>
									<th class="center">Bout</th>
									<th class="center req-actions"></th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="r in reqMngr.reqs track by $index">
									<td><strong>{{r.type.name}}<span ng-show="r.team">: {{r.team.name}}</span></strong></td>
									<td class="center">{{r.year}}</td>
									<td class="center">{{r.quarter}}</td>
									<td class="center">
										<div ng-hide="reqMngr.editingReqs[r.id]">{{r.practice}}</div>
										<div ng-show="reqMngr.editingReqs[r.id]"><input type="text" ng-model="r.practice" /></div>
									</td>
									<td class="center">
										<div ng-hide="reqMngr.editingReqs[r.id]">{{r.scrimmage}}</div>
										<div ng-show="reqMngr.editingReqs[r.id]"><input type="text" ng-model="r.scrimmage" /></div>
									</td>
									<td class="center">
										<div ng-hide="reqMngr.editingReqs[r.id]">{{r.activity}}</div>
										<div ng-show="reqMngr.editingReqs[r.id]"><input type="text" ng-model="r.activity" /></div>
									</td>
									<td class="center">
										<div ng-hide="reqMngr.editingReqs[r.id]">{{r.committee}}</div>
										<div ng-show="reqMngr.editingReqs[r.id]"><input type="text" ng-model="r.committee" /></div>
									</td>
									<td class="center">
										<div ng-hide="reqMngr.editingReqs[r.id]">{{r.facility}}</div>
										<div ng-show="reqMngr.editingReqs[r.id]"><input type="text" ng-model="r.facility" /></div>
									</td>
									<td class="center">
										<div ng-hide="reqMngr.editingReqs[r.id]">{{r.bout}}</div>
										<div ng-show="reqMngr.editingReqs[r.id]"><input type="text" ng-model="r.bout" /></div>
									</td>

									<td class="center">
										<div class="btn-actions" ng-if="reqMngr.currentYear === r.year && reqMngr.currentQtr <= r.quarter">
											<button class="btn btn-primary" ng-hide="reqMngr.editingReqs[r.id]" ng-click="reqMngr.modifyReq(r)">Modify</button>
											<button class="btn btn-primary" ng-hide="reqMngr.editingReqs[r.id]" ng-click="reqMngr.removeReq(r.id, $index)">Delete</button>
											<button class="btn btn-primary" ng-show="reqMngr.editingReqs[r.id]" ng-click="reqMngr.updateReq(r)">Update</button>
											<button class="btn" ng-show="reqMngr.editingReqs[r.id]" ng-click="reqMngr.resetReq(r)"><i class="fa fa-remove"></i></button>
										</div>
									</td>

								</tr>
							</tbody>
						</table>
					</div>
					<!-- /.table-responsive -->
				</div>

			</div>
			<!-- /.row -->

		</div>
		<!-- /#page-wrapper -->

		<script type="text/ng-template" id="requirementForm">
			@include('modals.practice-history')
		</script>

	</div>
</div>
<!-- /#page-content-wrapper -->

@endsection
