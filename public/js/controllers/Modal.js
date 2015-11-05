(function() {

	'use strict';

	angular
		.module('denverTracking')
		.controller('Modal', Modal);

		function Modal(_, $scope, $modalInstance, items, team, clockins) {
			var mod = this;

			mod.team = team.name;

			mod.tabs = [];
			_.each(clockins, function(clockin, qtr) {
				mod.tabs.push({title: 'Quarter '+qtr, clockin: clockin});
			});

			mod.ok = function () {
			  $modalInstance.close();
			};

			mod.cancel = function () {
				console.log('hi');
			  $modalInstance.dismiss('cancel');
			};
		}

})();