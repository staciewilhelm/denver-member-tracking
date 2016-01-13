(function() {

	'use strict';

	angular
		.module('denverTracking')
		.factory('user', user);

		function user($resource, $q, $http) {

			function autocomplete() {
				var deferred = $q.defer();
				$http({url: 'api/usersAutocomplete', method: 'GET'}).
					success(function(data) {
						deferred.resolve(data);
					}).
					error(function(error) {
						deferred.reject(error);
					});
				return deferred.promise;
			}

			// ngResource call to the API for the users
			var UsersRequirements = $resource('api/usersRequirements/:userId', {userId:'@id'}),
					UserClockNumbers = $resource('api/clockNumbers');

			// Query the users and return the results
			function getUsersRequirements(id) {
				return UsersRequirements.get({userId:id}).$promise.then(function(results) {
					return results;
				}, function(error) {
					console.log(error);
				});
			}

			function getUserClockNumbers() {
				return UserClockNumbers.query().$promise.then(function(results) {
					return results;
				}, function(error) {
					console.log(error);
				});
			}

			return {
				autocomplete: autocomplete,
				getUsersRequirements: getUsersRequirements,
				getUserClockNumbers: getUserClockNumbers
			}
		}

})();