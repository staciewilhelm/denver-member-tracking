@extends('app')

@section('content')


<!-- Page Content -->
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div id="page-wrapper">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Member Manager</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-9">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Member Name</th>
									<th>Derby Name / #</th>
									<th></th>
									<th>Phone</th>
									<th>Member Type</th>
									<th>Status</th>
									<th>Dues</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Melissa Withem</td>
									<td>Militia Vandal #4329</td>
									<td><a href="mailto:melissa@denverrollerderby.org">melissa@denverrollerderby.org</a></td>
									<td>432-342-2343</td>
									<td>Skater</td>
									<td><i class="fa fa-check fa-fw" ng-click="toggleMin()" tooltip="Member is Active"></i></td>
									<td><i class="fa fa-check fa-fw" ng-click="toggleMin()" tooltip="Dues are Current"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Richard Walther</td>
									<td>Dickie</td>
									<td><a href="mailto:walter@denverrollerderby.org">walter@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer</td>
									<td><i class="fa fa-check fa-fw" ng-click="toggleMin()" tooltip="Member is Active"></i></td>
									<td><i class="fa fa-check fa-fw" ng-click="toggleMin()" tooltip="Dues are Current"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Jamie Williams <i class="fa fa-star fa-fw"></i></td>
									<td>Krunchy</td>
									<td><a href="mailto:krunchy@denverrollerderby.org">krunchy@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer, Skater</td>
									<td><i class="fa fa-check fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Heather Juska</td>
									<td>Juska</td>
									<td><a href="mailto:juska@denverrollerderby.org">juska@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Skater</td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<!-- repeat some stuff -->
								<tr>
									<td>Jamie Williams <i class="fa fa-star fa-fw"></i></td>
									<td>Krunchy</td>
									<td><a href="mailto:krunchy@denverrollerderby.org">krunchy@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer, Skater</td>
									<td><i class="fa fa-check fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Heather Juska</td>
									<td>Juska</td>
									<td><a href="mailto:juska@denverrollerderby.org">juska@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Skater</td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Jamie Williams <i class="fa fa-star fa-fw"></i></td>
									<td>Krunchy</td>
									<td><a href="mailto:krunchy@denverrollerderby.org">krunchy@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer, Skater</td>
									<td><i class="fa fa-check fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Heather Juska</td>
									<td>Juska</td>
									<td><a href="mailto:juska@denverrollerderby.org">juska@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Skater</td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Jamie Williams <i class="fa fa-star fa-fw"></i></td>
									<td>Krunchy</td>
									<td><a href="mailto:krunchy@denverrollerderby.org">krunchy@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer, Skater</td>
									<td><i class="fa fa-check fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Heather Juska</td>
									<td>Juska</td>
									<td><a href="mailto:juska@denverrollerderby.org">juska@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Skater</td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Jamie Williams <i class="fa fa-star fa-fw"></i></td>
									<td>Krunchy</td>
									<td><a href="mailto:krunchy@denverrollerderby.org">krunchy@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer, Skater</td>
									<td><i class="fa fa-check fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Heather Juska</td>
									<td>Juska</td>
									<td><a href="mailto:juska@denverrollerderby.org">juska@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Skater</td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Jamie Williams <i class="fa fa-star fa-fw"></i></td>
									<td>Krunchy</td>
									<td><a href="mailto:krunchy@denverrollerderby.org">krunchy@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer, Skater</td>
									<td><i class="fa fa-check fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Heather Juska</td>
									<td>Juska</td>
									<td><a href="mailto:juska@denverrollerderby.org">juska@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Skater</td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Jamie Williams <i class="fa fa-star fa-fw"></i></td>
									<td>Krunchy</td>
									<td><a href="mailto:krunchy@denverrollerderby.org">krunchy@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer, Skater</td>
									<td><i class="fa fa-check fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Heather Juska</td>
									<td>Juska</td>
									<td><a href="mailto:juska@denverrollerderby.org">juska@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Skater</td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Jamie Williams <i class="fa fa-star fa-fw"></i></td>
									<td>Krunchy</td>
									<td><a href="mailto:krunchy@denverrollerderby.org">krunchy@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer, Skater</td>
									<td><i class="fa fa-check fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Heather Juska</td>
									<td>Juska</td>
									<td><a href="mailto:juska@denverrollerderby.org">juska@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Skater</td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Jamie Williams <i class="fa fa-star fa-fw"></i></td>
									<td>Krunchy</td>
									<td><a href="mailto:krunchy@denverrollerderby.org">krunchy@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer, Skater</td>
									<td><i class="fa fa-check fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Heather Juska</td>
									<td>Juska</td>
									<td><a href="mailto:juska@denverrollerderby.org">juska@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Skater</td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Jamie Williams <i class="fa fa-star fa-fw"></i></td>
									<td>Krunchy</td>
									<td><a href="mailto:krunchy@denverrollerderby.org">krunchy@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer, Skater</td>
									<td><i class="fa fa-check fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Heather Juska</td>
									<td>Juska</td>
									<td><a href="mailto:juska@denverrollerderby.org">juska@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Skater</td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Jamie Williams <i class="fa fa-star fa-fw"></i></td>
									<td>Krunchy</td>
									<td><a href="mailto:krunchy@denverrollerderby.org">krunchy@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer, Skater</td>
									<td><i class="fa fa-check fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Heather Juska</td>
									<td>Juska</td>
									<td><a href="mailto:juska@denverrollerderby.org">juska@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Skater</td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Jamie Williams <i class="fa fa-star fa-fw"></i></td>
									<td>Krunchy</td>
									<td><a href="mailto:krunchy@denverrollerderby.org">krunchy@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer, Skater</td>
									<td><i class="fa fa-check fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Heather Juska</td>
									<td>Juska</td>
									<td><a href="mailto:juska@denverrollerderby.org">juska@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Skater</td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Jamie Williams <i class="fa fa-star fa-fw"></i></td>
									<td>Krunchy</td>
									<td><a href="mailto:krunchy@denverrollerderby.org">krunchy@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer, Skater</td>
									<td><i class="fa fa-check fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Heather Juska</td>
									<td>Juska</td>
									<td><a href="mailto:juska@denverrollerderby.org">juska@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Skater</td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Jamie Williams <i class="fa fa-star fa-fw"></i></td>
									<td>Krunchy</td>
									<td><a href="mailto:krunchy@denverrollerderby.org">krunchy@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer, Skater</td>
									<td><i class="fa fa-check fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Heather Juska</td>
									<td>Juska</td>
									<td><a href="mailto:juska@denverrollerderby.org">juska@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Skater</td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Jamie Williams <i class="fa fa-star fa-fw"></i></td>
									<td>Krunchy</td>
									<td><a href="mailto:krunchy@denverrollerderby.org">krunchy@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Volunteer, Skater</td>
									<td><i class="fa fa-check fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
								<tr>
									<td>Heather Juska</td>
									<td>Juska</td>
									<td><a href="mailto:juska@denverrollerderby.org">juska@denverrollerderby.org</a></td>
									<td>423-154-3422</td>
									<td>Skater</td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td><i class="fa fa-warning icon-warning fa-fw"></i></td>
									<td>
										<a href="members/2/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/2/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history"></a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- /.table-responsive -->
				</div>

				<div class="col-lg-3">
					<div class="panel panel-default">
						<div class="panel-heading">
						    <i class="fa fa-bell fa-fw"></i> Notifications within the last 24 hours
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
						    <div class="list-group">
						        <a href="#" class="list-group-item">
						            <i class="fa fa-user fa-fw"></i> User updated
						            <span class="pull-right text-muted small"><em>4 minutes ago</em>
						            </span>
						        </a>
						        <a href="#" class="list-group-item" ng-click="toggleMin()" tooltip="Stacie Wilhelm clocked-in for League practice">
						            <i class="fa fa-clock-o fa-fw"></i> New Clock-in
						            <span class="pull-right text-muted small"><em>12 minutes ago</em>
						            </span>
						        </a>
						        <a href="#" class="list-group-item" ng-click="toggleMin()" tooltip="Denver charged Stacie Wilhelm for new crushers jersey">
						            <i class="fa fa-credit-card fa-fw"></i> Venmo Charge
						            <span class="pull-right text-muted small"><em>27 minutes ago</em>
						            </span>
						        </a>
						        <a href="#" class="list-group-item" ng-click="toggleMin()" tooltip="Denver received a payment from Stacie Wilhelm: August Dues $50.00">
						            <i class="fa fa-money fa-fw"></i> Payment Received
						            <span class="pull-right text-muted small"><em>Yesterday</em>
						            </span>
						        </a>
						    </div>
						    <!-- /.list-group -->
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel notifications -->
				</div>
				<!-- /.col-lg-3 -->
			</div>
			<!-- /.row -->

		</div>
		<!-- /#page-wrapper -->

	</div>
</div>
<!-- /#page-content-wrapper -->

@endsection
