(function() {

	var loadedOnce = false;

	'use strict';

	angular
		.module('denverTracking')
		.controller('TransactionMngr', TransactionMngr);

		function TransactionMngr(_, $scope, $timeout, $filter, $window, $modal, $log, coreData, coreFns, crudFns, user) {
			var tMngr = this,
					todayDate = new Date(),
					dueDate, timeDiff, daysDiff, transactionDate, formattedMember;

			tMngr.showSavedNote = false;
			tMngr.editingTData = {};
			tMngr.loaded = (loadedOnce) ? true : false;

			tMngr.currentYear = coreData.currentYear;
			tMngr.currentQtr = coreData.currentQuarter;
			tMngr.upcomingYrs = coreData.upcomingYears;
			tMngr.allQuarters = coreData.allQuarters;

			tMngr.dateOptions = coreData.dateOptions;
			tMngr.dateFormat = coreData.dateFormat;

			tMngr.due = null;
			tMngr.trans_date = null;

			tMngr.open = function($event, which) {
				// set value to null to eliminate directive error
				tMngr[which] = null;
				$event.preventDefault();
				$event.stopPropagation();
				tMngr.datepickers[which] = true;
			};

			// datepicker initialization
			tMngr.datepickers = {
				due: false,
				trans_date: false
			};

			$timeout(function() { tMngr.loaded = true; }, 1000);

			//$scope.$watch('searchMember', function(newValue, oldValue) {
			//	console.log('watching search member!', newValue, oldValue);
			//});

			tMngr.predicate = '-due';

			tMngr.toggleSort = function(selected) {
				tMngr.predicate = coreFns.toggle(selected, tMngr.predicate);
			}

			tMngr.setTransData = function(allTData) {
				tMngr.editingTData = {};
				tMngr.autocompleteMembers = [];

				// setup member data for auto complete
				user.autocomplete().then(function(members) {
					tMngr.memberData = members;
					_.each(members, function(m) {
						formattedMember = m.first_name + ' ' + m.last_name;
						if (!_.isNull(m.skater_name)) formattedMember += ' | ' + m.skater_name;
						formattedMember += ' (' + m.venmo_handle + ')';
						tMngr.autocompleteMembers.push(formattedMember);
					});

				}, function(error) {
					console.log('error', error);
				});

				// format transaction status
				_.each(allTData, function(t, tI) {
					t.status = 'Pending';
					if (t.trans_final === 1) {
						t.status = 'Paid';
					} else {
						dueDate = new Date(t.due);
						timeDiff = todayDate.getTime() - dueDate.getTime();
						daysDiff = timeDiff / (1000 * 3600 * 24);

						if (t.trans_desc.toLowerCase().includes('dues') && daysDiff > 10) t.status = 'Overdue';
						if (daysDiff > 30) t.status = daysDiff.toFixed() + ' days overdue';
					}
				});

				tMngr.transactions = allTData;

				_.each(allTData, function(t, tI) {
					tMngr.editingTData[tMngr.transactions[tI].id] = false;
				});
			};

			tMngr.setMember = function() {
				var selectedMember, selectedMemberInfo, selectedMemberName, selectedMemberObject;
				// only replace/split info if values exist
				if (!_.isEmpty($scope.searchMember)) {
					selectedMember = $scope.searchMember.replace(')', ''),
					selectedMemberInfo = selectedMember.split('@'),
					selectedMemberName = selectedMemberInfo[0].split(' | '),
					selectedMemberObject = _.find(tMngr.memberData, function(m) {
						return m.venmo_handle == ('@'+selectedMemberInfo[1]);
					});
				}
				// member object is found; set to scope
				if (!_.isUndefined(selectedMemberObject)) {
					$scope.selectedMemberName = selectedMemberName[0];
					$scope.selectedMemberId = selectedMemberObject.id;
				} else {
				// reset scope data
					$scope.searchMember = null;
					$scope.selectedMemberName = null;
					$scope.selectedMemberId = null;
				}
			}

			/* service calls for saving */
			tMngr.saveTransaction = function() {
				var newTransaction = {
					user_id: $scope.selectedMemberId,
					type: $scope.trans_type,
					trans_desc: $scope.desc,
					amount: $scope.amount,
					due: $filter('date')(tMngr.due, 'yyyy-MM-dd'),
					status: 'Pending'
				};

				if ($scope.trans_final) {
					newTransaction.trans_amount = $scope.amount;
					newTransaction.trans_final = 1;
					newTransaction.trans_date = $filter('date')(tMngr.trans_date, 'yyyy-MM-dd');
				}

				var memberObject = _.find(tMngr.memberData, function(m) {
					return m.id == newTransaction.user_id;
				});

				newTransaction.user_name = memberObject.first_name + ' ' + memberObject.last_name;
				newTransaction.user = {venmo_handle: memberObject.venmo_handle};

				if (newTransaction.trans_final) {
					newTransaction.status = 'Paid';
				} else {
					dueDate = new Date(newTransaction.due);
					timeDiff = todayDate.getTime() - dueDate.getTime();
					daysDiff = timeDiff / (1000 * 3600 * 24);

					if (newTransaction.trans_desc.toLowerCase().includes('dues') && daysDiff > 10) newTransaction.status = 'Overdue';
					if (daysDiff > 30) t.status = daysDiff.toFixed() + ' days overdue';
				}

				tMngr.transactions.push(newTransaction);

				crudFns.saveData('transaction', newTransaction).then(function(success) {
					console.log('saved!');

					$scope.searchMember = null;
					$scope.selectedMemberName = null;
					$scope.selectedMemberId = null;
					$scope.trans_type = '';
					$scope.amount = '';
					$scope.due = '';
					tMngr.due = '';
					$scope.desc = '';
					$scope.trans_final = '';
					$scope.trans_date = '';
					tMngr.trans_date = '';

				}, function(error) {
					console.log('error', error);
				});

				tMngr.showSavedNote = true;

				$timeout(function() { tMngr.showSavedNote = false; }, 3000);
			};

			tMngr.modifyTransaction = function(tData) {
				tMngr.editingTData[tData.id] = true;
			};

			tMngr.resetTransaction = function(tData) {
				tMngr.editingTData[tData.id] = false;
			};

			tMngr.updateTransaction = function(tData) {
				tMngr.editingTData[tData.id] = false;

				crudFns.updateData('transaction', tData).then(function(success) {
					console.log('updated!',success);
				}, function(error) {
					console.log('error', error);
				});

			};

			tMngr.removeTransaction = function(tId, tIndex) {
				tMngr.editingTData[tId] = false;

				crudFns.removeData('transaction', tId).then(function(success) {
					tMngr.transactions.splice(tIndex, 1);
				}, function(error) {
					console.log('error', error);
				});
			};

		};

})();