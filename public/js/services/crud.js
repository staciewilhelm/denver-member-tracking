(function() {

	'use strict';

	angular
		.module('denverTracking')
		.factory('crudFns', crudFns);

		function crudFns($q, $http) {
			var deferred = $q.defer(), 
					xsrf = angular.element(document.querySelector('meta[name="csrf-token"]')).attr('content'),
					httpConfig = {
						headers: {
							xsrfHeaderName: xsrf
						}
					};

			var getAPIUrl = function(type) {
				var moduleURL;
				switch(type) {
					case 'requirement':
						moduleURL = '/api/requirements';
						break;
					case 'transaction':
						moduleURL = '/api/transactions';
						break;
				}
				return moduleURL;
			}

			// Grab data passed from the view and send
			// a POST request to the API to save the data
			function saveData(moduleType, data) {
				if (_.isEmpty(getAPIUrl(moduleType))) return 'error';

				httpConfig.method = 'POST';
				httpConfig.params = data;
				httpConfig.url = getAPIUrl(moduleType);

				$http(httpConfig).
					success(function() {
						deferred.resolve();
					}).
					error(function(error) {
						deferred.reject(error);
					});
				return deferred.promise;
			}

			// Use a PUT request to save the updated data passed in
			function updateData(moduleType, data) {
				if (_.isEmpty(getAPIUrl(moduleType))) return 'error';

				httpConfig.method = 'PUT';
				httpConfig.params = data;
				httpConfig.url = getAPIUrl(moduleType) + '/'+data.id;

				$http(httpConfig).
					success(function() {
						deferred.resolve(data);
					}).
					error(function(error) {
						deferred.reject(error);
					});
				return deferred.promise;
			}

			// Send a DELETE request for a specific time entry
			function removeData(moduleType, dataId) {
				if (_.isEmpty(getAPIUrl(moduleType))) return 'error';

				httpConfig.method = 'DELETE';
				httpConfig.url = getAPIUrl(moduleType) + '/'+dataId;

				$http(httpConfig).
					success(function() {
						deferred.resolve();
					}).
					error(function(error) {
						deferred.reject(error);
					});
				return deferred.promise;
			}

			return {
				saveData: saveData,
				updateData: updateData,
				removeData: removeData
			}
		}

})();