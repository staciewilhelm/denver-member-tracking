(function() {

	'use strict';

	angular
		.module('denverTracking')
		.controller('Member', Member);

		function Member(_, $scope, $log, core, calcReqs) {

			var m = this;

			// set default values
			m.roleId = '';
			m.groupId = '';
			m.memberStatus = '';
			m.memberType = '';
			m.memberLevel = '';
			m.skaterLevel = '';

			m.homeTeams = [];
			m.travelTeams = [];
			m.selectedHomeTeam = null;
			m.seletedTravelTeams = [];

			m.showRecentTransactions = true;
			m.showRecentClockIns = false;
			m.showUserStandings = false;

			// set options
			m.currentQuarter = m.currentQuarter;
			m.memberStatuses = core.memberStatuses;
			m.memberTypes = core.memberTypes;
			m.memberLevels = core.memberLevels;
			m.skaterLevels = core.skaterLevels;

			/* Datepicker options*/
			m.today = core.today;

			m.dateOptions = core.dateOptions;
			m.format = core.dateFormat;

			m.open = function($event, which) {
				// set value to null to eliminate directive error
				m[which] = null;
				$event.preventDefault();
				$event.stopPropagation();
				m.datepickers[which]= true;
			};

			// datepicker initialization
			m.datepickers = {
				dob: false,
				join_date: false,
				induction_date: false,
				transfer_date: false,
				retired_date: false,
				activeStanding_start_date: false,
				activeStanding_end_date: false
			};

			m.setData = function(type, data, relatedData) {
				var pivotData;
				switch (type) {
					case 'committees':
						var allCommittees = [],
								len = data.length,
								mid = len / 2;

						_.each(data, function(committee) {
							committee.checked = false;
							// note the teams the user has selected
							pivotData = _.find(relatedData, function(c) {
								return c.pivot.committee_id === committee.id;
							});

							if (!_.isUndefined(pivotData)) committee.checked = true;

							allCommittees.push(committee);
						});

						m.committees = {left:[], right:[]};

						m.committees.left  = data.slice(0, mid);  
						m.committees.right = data.slice(mid, len);

						break;
					case 'groups':
						m.groups = data;
						break;
					case 'positions':
						m.positions = [];

						_.each(data, function(p) {
							pivotData = _.findWhere(relatedData, {id:p.id});
							p.checked = !_.isUndefined(pivotData) ? true : false;

							m.positions.push(p);
						});

						break;
					case 'roles':
						m.roles = data;
						break;
					case 'requirements':
						// base requirements
						// user's custom requirements
						// user's requirements count (aggregate of clock-ins but stored in users_requirements table)
						m.reqHeaders = calcReqs.getHeaders();

						var baseData = calcReqs.setBaseReqData(data),
								userReqData = calcReqs.setUserReqData(baseData.checkData, baseData.reqs, relatedData);

						m.reqsType = baseData.reqsType;

						m.currentReqs = userReqData.currentReqs;
						m.watchReqs = userReqData.watchReqs;

						break;
					case 'teams':
						var homeTeamCaptain = false,
								homeTeamCoach = false;
						_.each(data, function(team) {
							team.checked = team.is_captain = team.is_coach = false;
							// note the teams the user has selected
							pivotData = _.find(relatedData, function(t) {
								return t.pivot.team_id === team.id;
							});

							if (!_.isUndefined(pivotData)) {
								team.checked = true;
								team.is_captain = pivotData.pivot.is_captain ? true : false;
								team.is_coach = pivotData.pivot.is_coach ? true : false;
								// set correct variables
								if (team.team_type_id === 1) {
									m.selectedHomeTeam = team.id;
								} else {
									m.seletedTravelTeams.push(team.id);
								}
							}

							if (team.team_type_id === 1) {
								m.homeTeams.push(team);
							} else {
								m.travelTeams.push(team);
							}
						});

						break;
				}
			};

			m.setUserData = function(userData) {
				m.user = userData;

				m.roleId = userData.role_id;
				m.groupId = userData.group_id;

				m.venmoHandle = m.user.venmo_handle;
				m.identifiesAs = m.user.identifies_as;

				m.memberStatus = userData.mem_status;
				m.memberType = userData.mem_type;
				m.memberLevel = userData.mem_level;
				m.skaterLevel = userData.skater_level;

				m.dob = userData.dob;
				m.join_date = userData.join_date;
				m.induction_date = userData.induction_date;
				m.transfer_date = userData.transfer_date;
				m.retired_date = userData.retired_date;

				m.isTransfer = userData.is_transfer;
			};

			m.updateReqs = function(qtr, type) {
				var requiredCount = m.watchReqs[type][qtr].base,
						remainingCount = 0;

				// set amended value as new base count
				// if amended is empty, set remaining to original
				requiredCount = _.isEmpty(m.watchReqs[type][qtr].amended) ? m.watchReqs[type][qtr].base : requiredCount = m.watchReqs[type][qtr].amended;

				// set remaining count based on required (base or amended) - already clocked
				remainingCount = parseInt(requiredCount) - m.watchReqs[type][qtr].attended;
				// set remaining count to 0 in the case user has met more than required
				if (remainingCount < 0) remainingCount = 0;

				// set remaining requirements
				m.watchReqs[type][qtr].remaining = remainingCount;
			}

			m.setUserBelongsData = function(userClockins, userStandings, userTransactions) {
				// set quarter for each clockin
				m.userClockins = [];
				_.each(userClockins, function(c) {
					c.qtr = moment(c.clocked).quarter();
					m.userClockins.push(c);
				});

				// loop through user standings to ensure each has an end date
				m.userStandings = [];
				_.each(userStandings, function(standing) {
					// if a record does not has an end date, we will mark
					// it as active and pull it out of the listing
					if (_.isEmpty(standing.end_date)) {
						m.activeStanding = standing;
						m.activeStanding_start_date = standing.start_date;
						m.activeStanding_end_date = standing.end_date;
					} else {
						m.userStandings.push(standing);
					}
				});

				// loop through user standings to ensure each has an end date
				m.userTransactions = [];
				_.each(userTransactions, function(t) {
					m.userTransactions.push(t);
				});
			};

			m.updateValue = function(type, val) {
				switch (type) {
					case 'role':
						m.roleId = val;
						break;
					case 'group':
						m.groupId = val;
						break;
					case 'memberStatus':
						m.memberStatus = val;
						break;
					case 'memberType':
						m.memberType = val;
						break;
					case 'memberLevel':
						m.memberLevel = val;
						break;
					case 'skaterLevel':
						m.skaterLevel = val;
						break;
				}
			};

			/* Team Roles */
			m.enableTeamRoles = function(team_id) {
				m.selectedHomeTeam = team_id;
			};

			m.enableTTRoles = function(team_id) {
				// Does the filter exist in the sub array.
				var i = m.seletedTravelTeams.indexOf(team_id);

				// If it exists, remove the filter.
				if (i > -1) {
					m.seletedTravelTeams.splice(i, 1);

				// Otherwise add the filter.
				} else {
					m.seletedTravelTeams.push(team_id);
				}
			};

			/* Toggle Sidebar Data */
			m.toggleRecentTransactions = function() {
				if (!m.showRecentTransactions) {
					m.showRecentTransactions = true;
					m.showRecentClockIns = false;
					m.showUserStandings = false;
				}
			};

			m.toggleRecentClockins = function() {
				if (!m.showRecentClockIns) {
					m.showRecentClockIns = true;
					m.showRecentTransactions = false;
					m.showUserStandings = false;
				}
			};

			m.toggleUserStandings = function() {
				if (!m.showUserStandings) {
					m.showUserStandings = true;
					m.showRecentClockIns = false;
					m.showRecentTransactions = false;
				}
			};

			/* Prepend value (ie @) */
			m.prepend = function(val) {
				if (val === '@') {
					var stripped = m.venmoHandle.replace(/@/g, '');
					if (stripped.length > 0) m.venmoHandle = '@' + stripped;
				}
			};

			/* Local functions */


			//m.memberType = function() {
			//	if ()
			//}

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
					m.showEditDialog = false;
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