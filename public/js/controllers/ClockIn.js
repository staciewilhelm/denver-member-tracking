(function() {

	'use strict';

	angular
		.module('denverTracking')
		.controller('ClockIn', ClockIn);

		function ClockIn(events, user, $scope, $timeout, $location) {
			var clock = this,
					tickInterval = 1000; //ms

			clock.numberIsValid = true;
			clock.currentTime = 'loading clock...'; // initialise the time variable

			var tick = function() {
				clock.currentTime = Date.now() // get the current time
				$timeout(tick, tickInterval); // reset the timer
			}

			// Start the timer
			$timeout(tick, tickInterval);

			var getUpcomingEvents = function() {
				events.getUpcoming().then(function(result) {
					var formattedList = [],
							eventList = [];

					_.each(result, function(r, rI) {
						if (rI !== '$promise' && rI !== '$resolved') {
							eventList = [];
							_.each(r, function(e) {
								eventList.push({details:e.display});
							});
							formattedList.push({date: rI, events: eventList});
						}
					});

					clock.eventList = formattedList;

				}, function(error) {
					console.log(error);
				});
			}

			var getUserClockNumbers = function() {
				user.getUserClockNumbers().then(function(result) {
					clock.userNumbers = result;
				}, function(error) {
					console.log(error);
				});
			}

			clock.setData = function() {
				getUpcomingEvents();
				getUserClockNumbers();
			}

			clock.setLateOption = function(selected) {
				clock.isOther = selected;
			}

			clock.verifyNumber = function() {
				clock.numberIsValid = (clock.userNumbers.indexOf(parseInt(clock.number)) > -1) ? true : false;
			}

		}

})();