<div class="modal-header">
	<h3 class="modal-title">Practice History for {{mod.memberName}}</h3>
</div>
<div class="modal-body">

	<tabset>
		<tab ng-repeat="tab in mod.tabs" heading="{{tab.title}}" active="tab.active">
			<!-- <p><span class="warning">late clock-in / invalid practice</span></p>
			<p><i class="fa fa-check"></i> = on-time clock-in | <i class="fa fa-times"></i> = excused clock-in</p> -->

			<div class="table-responsive modal-table team-users-clockins">
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="lft">User
								<span
									class="fa"
									ng-show="tab.clockin.length > 1"
									ng-class="{'fa-arrow-up': mod.predicate.indexOf('-') === -1, 'fa-arrow-down': mod.predicate.indexOf('-') > -1}" 
									ng-click="mod.toggleSort('user.skater_name')"></span>
							</th>
							<th>Practice</th>
							<th>Scrimmage</th>
							<th>Bout</th>
							<th>Committee</th>
							<th>Activity</th>
							<th>Facility</th>
							<th>Standing</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="(u, c) in tab.clockin | orderBy:mod.predicate">
							<td class="lft"><a href="mailto:{{c.user.email}}">{{c.user.skater_name || (c.user.first_name +' '+c.user.last_name)}}</a></td>
							<td>{{c.practice.attended}} / {{c.practice.remaining}}</td>
							<td>{{c.scrimmage.attended}} / {{c.scrimmage.remaining}}</td>
							<td>{{c.activity.attended}} / {{c.activity.remaining}}</td>
							<td>{{c.facility.attended}} / {{c.facility.remaining}}</td>
							<td>{{c.bout.attended}} / {{c.bout.remaining}}</td>
							<td>{{c.committee.attended}} / {{c.committee.remaining}}</td>
							<td><span ng-class="{'invalid': c.user.standing !== 'Active'}">{{c.user.standing}}</span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</tab>
	</tabset>

</div>
<div class="modal-footer">
	<button class="btn btn-primary" type="button" ng-click="mod.ok()">OK</button>
</div>