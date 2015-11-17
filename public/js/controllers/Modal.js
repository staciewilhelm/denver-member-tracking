(function() {

	'use strict';

	angular
		.module('denverTracking')
		.controller('Modal', Modal);

		function Modal(_, $scope, $modalInstance, items, team, clockins) {
			var mod = this,
					clockArr;

			mod.team = team.name;
			mod.predicate = 'user.skater_name';
			mod.tabs = [];
			_.each(clockins, function(clockin, qtr) {
				// for sorting purposes
				clockArr = Object.keys(clockin).map(function(key) {
					return clockin[key];
				});
				mod.tabs.push({title: 'Quarter '+qtr, clockin: clockArr});
			});

			var ToggleData = function(selected, current) {
				if (current === selected && current.indexOf('-') === -1) {
					return '-'+selected;
				} else {
					return selected;
				}
			};

			mod.toggleSort = function(selected) {
				mod.predicate = ToggleData(selected, mod.predicate);
			}

			mod.ok = function () {
			  $modalInstance.close();
			};

			mod.cancel = function () {
				console.log('hi');
			  $modalInstance.dismiss('cancel');
			};
		}

})();