@extends('app')

@section('content')

<!-- Page Content -->
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div id="page-wrapper" 
			class="member-list" 
			ng-controller="TransactionMngr as tMngr"
			ng-init="tMngr.setTransData([[$transactions]]);">

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Venmo Transactions</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->

			<div class="row">
				<form class="form-horizontal transaction-form" role="form" name="saveTransaction" accept-charset="UTF-8" method="post" ng-submit="tMngr.saveTransaction()">

					<div class="row col-lg-8">
						<div class="row col-lg-9 form-group" ng-class="{'val-err': saveTransaction.user_id.$invalid}">
							<label class="block">Charge to:</label>
							<autocomplete ng-model="searchMember" 
								attr-placeholder="Search by Member Name, Derby Name or Venmo Handle..." 
								data="tMngr.autocompleteMembers"
								ng-blur="tMngr.setMember()"
								autocomplete-required="true">
							</autocomplete>
						</div>
						<div class="clear"></div>

						<div class="row form-group">
							<div class="col-lg-2" ng-class="{'val-err': saveTransaction.trans_type.$invalid}">
								<label class="block select-lbl">Transaction Type</label>
								<select name="trans_type" ng-model="trans_type" ng-required="true">
									<option value="">Choose One&hellip;</option>
									<option value="Charge">Charge</option>
									<option value="Payment">Payment</option>
								</select>
							</div>

							<div class="col-lg-2">
								<label class="block"><span ng-bind="trans_type"></span> To</label>
								<span ng-bind="selectedMemberName"></span>
								<input type="hidden" required="required" name="user_id" ng-model="selectedMemberId" />
							</div>

							<div class="col-lg-2" ng-class="{'val-err': saveTransaction.amount.$invalid}">
								<label class="block">Amount</label>
								<input type="number" class="form-control" step="0.01" maxlength="7" name="amount" ng-model="amount" ng-required="true" />
							</div>

							<div class="col-lg-4 datepicker-wrap" ng-class="{'val-err': saveTransaction.due.$invalid}">
								<label class="block">Due Date</label>
								<input type="text"
									class="form-control half"
									placeholder="mm/dd/yyyy"
									name="due"
									ng-value="due"
									ng-model="tMngr.due"
									ng-required="true"
									datepicker-popup="{{tMngr.dateFormat}}"
									datepicker-options="{{tMngr.dateOptions}}"
									is-open="tMngr.datepickers.due" />
								<span class="input-group-btn">
									<button type="button" class="btn btn-default" ng-click="tMngr.open($event,'due')">
										<i class="fa fa-calendar"></i>
									</button>
								</span>
							</div>
						</div><!-- end row -->
						<div class="row">
							<div class="col-lg-6" ng-class="{'val-err': saveTransaction.desc.$invalid}">
								<label class="block">Description</label>
								<textarea class="form-control" max-length="255" name="desc" ng-model="desc" ng-required="true"></textarea>
							</div>
							<div ng-cloak ng-show="tMngr.loaded && trans_type === 'Charge'" class="col-lg-4 top-pd">
								<label class="block">Charge Paid?</label>
								<input type="checkbox" name="trans_final" ng-model="trans_final" value="1" />
								<div ng-if="trans_final" class="datepicker-wrap" ng-class="{'val-err': saveTransaction.trans_date.$invalid}">
									<label class="block">Paid Date</label>
									<div class="clear"></div>
									<input type="text"
										class="form-control half"
										placeholder="mm/dd/yyyy"
										name="trans_date"
										ng-value="trans_date"
										ng-model="tMngr.trans_date"
										ng-required="trans_final"
										datepicker-popup="{{tMngr.dateFormat}}"
										datepicker-options="{{tMngr.dateOptions}}"
										is-open="tMngr.datepickers.trans_date" />
									<span class="input-group-btn">
										<button type="button" class="btn btn-default" ng-click="tMngr.open($event,'trans_date')">
											<i class="fa fa-calendar"></i>
										</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row col-lg-4">
						<button type="submit" class="btn btn-primary" ng-disabled="saveTransaction.$invalid">Save Transaction</button>
						<div class="clear"></div>
						<div ng-cloak ng-show="tMngr.loaded && tMngr.showSavedNote" class="success-msg">
							<i class="fa fa-check"></i>Saved!
							<!-- <i class="fa fa-warning"></i> -->
						</div>
					</div>

					<div class="clear"></div>
				</form>
				<hr />
			</div><!-- end form row -->

			<div class="loading-spinner" ng-hide="tMngr.loaded"><span class="fa fa-spinner fa-pulse fa-5x"></span></div>

			<div ng-cloak ng-show="tMngr.loaded" class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-hover transactions-table">
							<thead>
								<tr>
									<th>Member Name (Venmo Handle)
										<span
										class="fa"
										ng-class="{
											'fa-arrows-v': tMngr.predicate.indexOf('user_name') === -1,
											'fa-arrow-up': (tMngr.predicate.indexOf('user_name') > -1) && (tMngr.predicate.indexOf('-') === -1), 
											'fa-arrow-down': (tMngr.predicate.indexOf('user_name') > -1) && (tMngr.predicate.indexOf('-') > -1)
										}" 
										ng-click="tMngr.toggleSort('user_name')"></span>
									</th>
									<th class="center">Transaction Type
										<span
										class="fa"
										ng-class="{
											'fa-arrows-v': tMngr.predicate.indexOf('type') === -1,
											'fa-arrow-up': (tMngr.predicate.indexOf('type') > -1) && (tMngr.predicate.indexOf('-') === -1), 
											'fa-arrow-down': (tMngr.predicate.indexOf('type') > -1) && (tMngr.predicate.indexOf('-') > -1)
										}" 
										ng-click="tMngr.toggleSort('type')"></span>
									</th>
									<th>Description</th>
									<th class="center">Amount</th>
									<th class="center">Due Date
										<span
										class="fa"
										ng-class="{
											'fa-arrows-v': tMngr.predicate.indexOf('due') === -1,
											'fa-arrow-up': (tMngr.predicate.indexOf('due') > -1) && (tMngr.predicate.indexOf('-') === -1), 
											'fa-arrow-down': (tMngr.predicate.indexOf('due') > -1) && (tMngr.predicate.indexOf('-') > -1)
										}" 
										ng-click="tMngr.toggleSort('due')"></span>
									</th>
									<th>Status
										<span
										class="fa"
										ng-class="{
											'fa-arrows-v': tMngr.predicate.indexOf('status') === -1,
											'fa-arrow-up': (tMngr.predicate.indexOf('status') > -1) && (tMngr.predicate.indexOf('-') === -1), 
											'fa-arrow-down': (tMngr.predicate.indexOf('status') > -1) && (tMngr.predicate.indexOf('-') > -1)
										}" 
										ng-click="tMngr.toggleSort('status')"></span>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="t in tMngr.transactions track by $index | orderBy: tMngr.predicate" 
									ng-class="{overdue: t.status !== 'Paid' && t.status !== 'Pending'}">
									<td><strong>{{t.user_name}}</strong> ({{t.user.venmo_handle}})</td>
									<td class="center">{{t.type}}</td>
									<td>
										<div ng-hide="tMngr.editingTData[t.id]">{{t.trans_desc}}</div>
										<div ng-show="tMngr.editingTData[t.id]">
											<input type="text" class="form-control med" maxlength="255" ng-model="t.trans_desc" />
										</div>
									</td>
									<td class="center">
										<div ng-hide="tMngr.editingTData[t.id]">${{t.amount}}</div>
										<div ng-show="tMngr.editingTData[t.id]">
											<input type="number" class="form-control sm" step="0.01" maxlength="7" ng-model="t.amount" />
										</div>
									</td>
									<td class="center">{{t.due | date:'MM/dd/yyyy'}}</td>
									<td>{{t.status}}<span ng-show="t.trans_final" class="trans-date"> ({{t.trans_date | date:'MM/dd/yyyy'}})</span></td>

									<td class="center">
										<div class="btn-actions">
											<button class="btn btn-primary" ng-hide="tMngr.editingTData[t.id]" ng-click="tMngr.modifyTransaction(t)">Modify</button>
											<button class="btn btn-primary" ng-hide="tMngr.editingTData[t.id]" ng-click="tMngr.removeTransaction(t.id, $index)">Delete</button>
											<button class="btn btn-primary" ng-show="tMngr.editingTData[t.id]" ng-click="tMngr.updateTransaction(t)">Update</button>
											<button class="btn" ng-show="tMngr.editingTData[t.id]" ng-click="tMngr.resetTransaction(t)"><i class="fa fa-remove"></i></button>
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

	</div>
</div>
<!-- /#page-content-wrapper -->

@endsection
