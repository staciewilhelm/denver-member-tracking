(function() {

	'use strict';

	angular
		.module('denverTracking')
		.controller('Dashboard', Dashboard);

		function Dashboard(_, $scope, core, $modal, $log, calcReqs) {

			var d = this;

			d.showAccountInfo = true;
			d.showPracticeHistory = false;

			// set default values
			d.roleId = '';
			d.groupId = '';
			d.memberStatus = '';
			d.memberType = '';
			d.memberLevel = '';
			d.skaterLevel = '';

			d.homeTeams = [];
			d.travelTeams = [];
			d.selectedHomeTeam = null;
			d.seletedTravelTeams = [];

			// set options
			d.currentQuarter = core.currentQuarter;
			d.memberStatuses = core.memberStatuses;
			d.memberTypes = core.memberTypes;
			d.memberLevels = core.memberLevels;
			d.skaterLevels = core.skaterLevels;
			d.gURLs = core.googleURLs;

			d.setUserData = function(userData) {
				d.user = userData;

				d.user.teamClockinsStandings

				/*d.roleId = userData.role_id;
				d.groupId = userData.group_id;*/

				d.venmoHandle = d.user.venmo_handle.replace(/@/g, '');
				d.memberStatus = userData.mem_status;
				/*d.identifiesAs = d.user.identifies_as;

				
				d.memberType = userData.mem_type;
				d.memberLevel = userData.mem_level;
				d.skaterLevel = userData.skater_level;

				d.dob = userData.dob;
				d.join_date = userData.join_date;
				d.induction_date = userData.induction_date;
				d.transfer_date = userData.transfer_date;
				d.retired_date = userData.retired_date;

				d.isTransfer = userData.is_transfer;*/
			};

			d.setUserBelongsData = function(userClockins, userStandings, userTransactions, teamClockinsStandings) {
				// set quarter for each clockin
				d.userClockins = [];

				d.loggedPractices = 0;
				d.loggedScrimmages = 0;

				_.each(userClockins, function(c) {
					c.qtr = moment(c.clocked).quarter();

					switch (c.type) {
						case 'practice':
							d.loggedPractices++;
							break;
						case 'scrimmage':
							d.loggedScrimmages++;
							break;
					}

					d.userClockins.push(c);
				});

				d.activeStanding = null;
				// loop through user standings to ensure each has an end date
				_.each(userStandings, function(standing) {
					// if a record does not has an end date, we will mark
					// it as active and pull it out of the listing
					if (_.isEmpty(standing.end_date)) d.activeStanding = standing;
				});

				// loop through user standings to ensure each has an end date
				d.userTransactions = [];
				d.currentBalance = 0;
				d.balancePastDue = false;
				d.balanceDueDate = null;

				d.currBalance = {
					amount: 0,
					pastDue: false,
					dueDate: null,
					desc: ''
				};

				_.each(userTransactions, function(t) {
					if (t.type === 'Charge' && _.isNull(t.trans_final)) {
						d.currBalance.amount += t.amount;
						d.currBalance.desc += t.desc+(_.isNull(d.currBalance.desc) ? '' : '; ');

						if (_.isNull(d.currBalance.dueDate) || (!_.isNull(d.currBalance.dueDate) && new Date(t.due) < d.currBalance.dueDate))
							d.currBalance.dueDate = new Date(t.due);

						if (new Date(core.today) > new Date(t.due)) d.currBalance.pastDue = true;
					}

					d.userTransactions.push(t);

				});
			};

			d.setRequirementData = function(data, relatedData) {
				d.remReqs = calcReqs.getRemaining(data, relatedData);
			};

			d.setRelatedData = function(committees, positions, teams) {
				d.committees = [];
				d.isACommitteeHead = false;
				var isHead = false;
				_.each(committees, function(c) {
					if (!d.isACommitteeHead && (c.head_user_id === d.user.id)) d.isACommitteeHead = true;
					isHead = (c.head_user_id === d.user.id) ? true : false;
					d.committees.push({name:c.name, googleRef: c.google_ref, isHead: isHead});
				});

				d.positions = [];
				_.each(positions, function(p) {
					d.positions.push({name:p.name});
				});

				d.teams = [];
				d.coachTeams = [];
				d.captainTeams = [];
				d.teamClockinsStandings = [];
				_.each(teams, function(p) {
					if (p.pivot.is_coach) d.coachTeams.push(p.name);
					if (p.pivot.is_captain) d.captainTeams.push(p.name);
					if (p.pivot.is_captain || p.pivot.is_coach) d.teamClockinsStandings.push(p);
					d.teams.push({name:p.name});
				});
			};

			/* Modal */
			d.modalOpen = function (type, teamId) {
				var modalInstance = $modal.open({
					backdrop: false,
					scope: $scope,
					templateUrl: 'practiceHistory',
					controller: 'Modal',
					controllerAs: 'mod',
					size: 'lg',
					resolve: {
						items: function () {
							return ['HI', 'hola', 'yo'];
						},
						team: function () {
							return _.findWhere(d.teamClockinsStandings, {id:teamId});
						},
						clockins: function () {
							return d.user.teamClockinsStandings[teamId];
						}
					}
				});

				modalInstance.result.then(function (selectedItem) {
					$scope.selected = selectedItem;
				}, function () {
					$log.info('Modal dismissed at: ' + new Date());
				});
		  };

			/* Toggle Sidebar Data */
			d.toggleTransactions = function() {
				if (!d.showAccountInfo) {
					d.showAccountInfo = true;
					d.showRecentClockIns = false;
				}
			};

			d.toggleRecentClockins = function() {
				if (!d.showRecentClockIns) {
					d.showRecentClockIns = true;
					d.showAccountInfo = false;
				}
			};


			/* Local functions */

			
/*
			dash.timeentries = [];
			dash.totalTime = {};
			dash.users = [];

			// Initialize the clockIn and clockOut times to the current time.
			dash.clockIn = moment();
			dash.clockOut = moment();

			// Grab all the time entries saved in the database
			getTimeEntries();

			// Get the users from the database so we can select
			// who the time entry belongs to
			getUsers();

			function getUsers() {
				user.getUsers().then(function(result) {
					dash.users = result;
				}, function(error) {
					console.log(error);
				});
			}

			// Fetches the time entries and puts the results
			// on the dash.timeentries array
			function getTimeEntries() {
				time.getTime().then(function(results) {
					dash.timeentries = results;
						updateTotalTime(dash.timeentries);
						console.log(dash.timeentries);
					}, function(error) {
						console.log(error);
					});
				}
			}

			// Submit the time entry that will be called 
			// when we click the "Log Time" button
			dash.logNewTime = function() {
				// Make sure that the clock-in time isn't after
				// the clock-out time!
				if(dash.clockOut < dash.clockIn) {
					alert("You can't clock out before you clock in!");
					return;
				}

				// Make sure the time entry is greater than zero
				if(dash.clockOut - dash.clockIn === 0) {
					alert("Your time entry has to be greater than zero!");
					return;
				}

				// Call to the saveTime method on the time service
				// to save the new time entry to the database
				time.saveTime({
					"user_id":dash.timeEntryUser.id,
					"start_time":dash.clockIn,
					"end_time":dash.clockOut,
					"comment":dash.comment
				}).then(function(success) {
					getTimeEntries();
					console.log(success);
				}, function(error) {
					console.log(error);
				});

				getTimeEntries();

				// Reset clockIn and clockOut times to the current time
				dash.clockIn = moment();
				dash.clockOut = moment();

				// Clear the comment field
				dash.comment = "";

				// Deselect the user
				dash.timeEntryUser = "";

			}

			dash.updateTimeEntry = function(timeentry) {

				// Collect the data that will be passed to the updateTime method
				var updatedTimeEntry = {
					"id":timeentry.id,
					"user_id":timeentry.user.id,
					"start_time":timeentry.start_time,
					"end_time":timeentry.end_time,
					"comment":timeentry.comment
				}

				// Update the time entry and then refresh the list
				time.updateTime(updatedTimeEntry).then(function(success) {
					getTimeEntries();
					$scope.showEditDialog = false;
					console.log(success);
				}, function(error) {
					console.log(error);
				});

			}

			// Specify the time entry to be deleted and pass it to the deleteTime method on the time service
			dash.deleteTimeEntry = function(timeentry) {

				var id = timeentry.id;

				time.deleteTime(id).then(function(success) {
					getTimeEntries();
					console.log(success);
				}, function(error) {
					console.log(error);
				});

			}
*/
		}

})();