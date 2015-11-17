@extends('app')

@section('content')

<!-- Page Content -->
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div id="page-wrapper" 
			ng-controller="MemberMngr as mMngr"
			ng-init="mMngr.setUserData([[$users]]);">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Member Manager</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Member Name
										<span
										class="fa"
										ng-class="{'fa-arrow-up': !mMngr.predicateIsName || (mMngr.predicateIsName && mMngr.predicate[0].indexOf('-') === -1), 
										'fa-arrow-down': mMngr.predicateIsName && mMngr.predicate[0].indexOf('-') > -1}" 
										ng-click="mMngr.toggleSort('name')"></span>
									</th>
									<th>Derby Name / #
										<span
										class="fa"
										ng-class="{'fa-arrow-up': mMngr.predicate.indexOf('-') === -1, 'fa-arrow-down': mMngr.predicate.indexOf('-') > -1}" 
										ng-click="mMngr.toggleSort('skater_name')"></span>
									</th>
									<th>Denver Email</th>
									<th>Alt. Email</th>
									<th>Phone</th>
									<th class="center">Member Type</th>
									<th class="center">Status</th>
									<th class="center">Dues</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="u in mMngr.users | orderBy:mMngr.predicate">
									<td>{{u.first_name}} {{u.last_name}}
										<i ng-if="u.mem_status === 'Pending'" class="fa fa-star fa-fw" tooltip="Member Pending"></i>
									</td>
									<td>{{u.skater_name}}<span ng-show="u.skater_no"> #{{u.skater_no}}</span></td>
									<td><a href="mailto:{{u.email}}">{{u.email}}</a></td>
									<td><a href="mailto:{{u.alt_email}}">{{u.alt_email}}</a></td>
									<td>{{u.phone}}</td>
									<td class="center">{{u.mem_type}}</td>
									<td class="center"><i class="fa fa-check fa-fw" ng-click="toggleMin()" tooltip="Member is {{u.mem_status}}"></i></td>
									<td class="center">
										<!-- <i class="fa fa-warning icon-warning fa-fw" ng-click="toggleMin()" tooltip="Dues are Owed"></i> -->
										<i class="fa fa-check fa-fw" ng-click="toggleMin()" tooltip="Dues are Current"></i>
									</td>
									<td>
										<a href="members/{{u.id}}/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/{{u.id}}/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<!-- <a href="members/{{u.id}}/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history (modal for coaches/captains)"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; -->
										<a href="members/{{u.id}}/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
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

	</div>
</div>
<!-- /#page-content-wrapper -->

@endsection
