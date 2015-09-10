(function() {

	'use strict';

	angular
		.module('denverTracking')
		.controller('Member', Member);

		function Member($scope, $log) {

			var m = this;

			m.hideMemberSidebar = false;
			m.showTransactions = true;

			m.toggleMemberSidebar = function() {
				if (m.showPracticeHistory) {
					m.showPracticeHistory = false;
					m.showTransactions = true;
				} else {
					if (m.hideMemberSidebar) {
						m.showTransactions = true;
						m.hideMemberSidebar = false;
					} else {
						m.showTransactions = false;
						m.hideMemberSidebar = true;
					}
				}
			};

			m.practiceHistory = function() {
				if (m.showTransactions) {
					m.showTransactions = false;
					m.showPracticeHistory = true;
				} else {
					if (m.hideMemberSidebar) {
						m.showPracticeHistory = true;
						m.hideMemberSidebar = false;
					} else {
						m.showPracticeHistory = false;
						m.hideMemberSidebar = true;
					}
				}
			};

			m.prepend = function(val) {
				if (m.venmo_handle !== '')
					m.venmo_handle = val + m.venmo_handle.replace(/\@/g, '');
			}

			m.dateOptions = {
				'year-format': 'yy',
				'starting-day': 1
			};
			m.format = 'MM/dd/yyyy';

			m.open = function($event, which) {
				$event.preventDefault();
				$event.stopPropagation();
				m.datepickers[which]= true;
			};

			// datepicker initialization
			m.datepickers = {
				dob: false,
				induction_date: false,
				join_date: false,
				transfer_date: false,
				retirement_date: false
			};





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