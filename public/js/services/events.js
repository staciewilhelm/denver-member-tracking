(function() {

	'use strict';

	angular
		.module('denverTracking')
		.factory('events', events);

		function events($resource) {

			// ngResource call to the API with id as a paramaterized URL
			// and setup for the update method
			var upcoming = $resource('api/upcomingEvents');

			// $promise.then allows us to intercept the results of the 
			// query so we can add the loggedTime property
			function getUpcoming() {
				return upcoming.get().$promise.then(function(results) {
					return results;
				}, function(error) { // Check for errors
					console.log(error);
				});
			}

			return {
				getUpcoming: getUpcoming
			}

		}


})();