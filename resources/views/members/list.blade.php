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
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Member Name</th>
									<th>Derby Name / #</th>
									<th></th>
									<th>Phone</th>
									<th class="center">Member Type</th>
									<th class="center">Status</th>
									<th class="center">Dues</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($users as $user)
								<tr>
									<td>[[$user->first_name]] [[$user->last_name]]
										@if ($user->mem_status === 'Pending')<i class="fa fa-star fa-fw" tooltip="Member Pending"></i>@endif
									</td>
									<td>[[$user->skater_name]] [[ isset($user->skater_no) ? '#'.$user->skater_no : '']]</td>
									<td><a href="mailto:[[$user->email]]">[[$user->email]]</a></td>
									<td>[[$user->phone]]</td>
									<td class="center">[[$user->mem_type]]</td>
									<td class="center"><i class="fa fa-check fa-fw" ng-click="toggleMin()" tooltip="Member is [[$user->mem_status]]"></i></td>
									<td class="center">
										<!-- <i class="fa fa-warning icon-warning fa-fw" ng-click="toggleMin()" tooltip="Dues are Owed"></i> -->
										<i class="fa fa-check fa-fw" ng-click="toggleMin()" tooltip="Dues are Current"></i>
									</td>
									<td>
										<a href="members/[[$user->id]]/update" class="fa fa-pencil fa-fw" ng-click="toggleMin()" tooltip="Edit Member Details"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/[[$user->id]]/details" class="fa fa-eye fa-fw" ng-click="toggleMin()" tooltip="View Member Details (modal for coaches/captains)"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/[[$user->id]]/payments" class="fa fa-money fa-fw" ng-click="toggleMin()" tooltip="Payment history (modal for coaches/captains)"></a>
										&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
										<a href="members/[[$user->id]]/practices" class="fa fa-list-alt fa-fw" ng-click="toggleMin()" tooltip="Practice history (modal for coaches/captains)"></a>
									</td>
								</tr>
								@endforeach
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
