(function() {

	'use strict';

	angular
		.module('denverTracking')
		.controller('ClockIn', ClockIn);

		function ClockIn(userClockins, user, $scope) {
			var clock = this;

			clock.whateverThings = function() {
				console.log('awesome');
			}

			clock.late = true;

			clock.showLateOptions = function() {
				console.log('show other stuff');
				clock.late = true;
			}

			clock.setLateOption = function(selected) {
				clock.isOther = selected;
			}

			clock.timeentries = [];
			clock.totalTime = {};
			clock.users = [];

			// Initialize the clockIn and clockOut times to the current userClockins.
			clock.clockIn = moment();
			clock.clockOut = moment();

			// Grab all the time entries saved in the database
			getTimeEntries();

			// Get the users from the database so we can select
			// who the time entry belongs to
			getUsers();

			function getUsers() {
				user.getUsers().then(function(result) {
					clock.users = result;
				}, function(error) {
					console.log(error);
				});
			}

			// Fetches the time entries and puts the results
			// on the clock.timeentries array
			function getTimeEntries() {
				userClockins.getTime().then(function(results) {
					clock.timeentries = results;
					updateTotalTime(clock.timeentries);
					console.log(clock.timeentries);
				}, function(error) {
					console.log(error);
				});
			}

			// Updates the values in the total time box by calling the
			// getTotalTime method on the time service
			function updateTotalTime(timeentries) {
				//clock.totalTime = userClockins.getTotalTime(timeentries);
			}

			// Submit the time entry that will be called 
			// when we click the "Log Time" button
			clock.logNewTime = function() {
				// Make sure that the clock-in time isn't after
				// the clock-out time!
				if(clock.clockOut < clock.clockIn) {
					alert("You can't clock out before you clock in!");
					return;
				}

				// Make sure the time entry is greater than zero
				if(clock.clockOut - clock.clockIn === 0) {
					alert("Your time entry has to be greater than zero!");
					return;
				}

				// Call to the saveTime method on the time service
				// to save the new time entry to the database
				userClockins.saveTime({
					"user_id":clock.timeEntryUser.id,
					"start_time":clock.clockIn,
					"end_time":clock.clockOut,
					"comment":clock.comment
				}).then(function(success) {
					getTimeEntries();
					console.log(success);
				}, function(error) {
					console.log(error);
				});

				getTimeEntries();

				// Reset clockIn and clockOut times to the current time
				clock.clockIn = moment();
				clock.clockOut = moment();

				// Clear the comment field
				clock.comment = "";

				// Deselect the user
				clock.timeEntryUser = "";

			}

			clock.updateTimeEntry = function(timeentry) {

				// Collect the data that will be passed to the updateTime method
				var updatedTimeEntry = {
					"id":timeentry.id,
					"user_id":timeentry.user.id,
					"start_time":timeentry.start_time,
					"end_time":timeentry.end_time,
					"comment":timeentry.comment
				}

				// Update the time entry and then refresh the list
				userClockins.updateTime(updatedTimeEntry).then(function(success) {
					getTimeEntries();
					$scope.showEditDialog = false;
					console.log(success);
				}, function(error) {
					console.log(error);
				});

			}

			// Specify the time entry to be deleted and pass it to the deleteTime method on the time service
			clock.deleteTimeEntry = function(timeentry) {

				var id = timeentry.id;

				userClockins.deleteTime(id).then(function(success) {
					getTimeEntries();
					console.log(success);
				}, function(error) {
					console.log(error);
				});

			}



		}


})();