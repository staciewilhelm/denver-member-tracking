(function() {

	'use strict';

	angular
		.module('denverTracking')
		.controller('ModalClockinsStandings', ModalClockinsStandings)
		.controller('ModalPracticeHistory', ModalPracticeHistory);

		function ModalClockinsStandings(_, $scope, $modalInstance, coreFns, team, clockins) {
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

			mod.toggleSort = function(selected) {
				mod.predicate = coreFns.toggle(selected, mod.predicate);
			}

			mod.ok = function () {
			  $modalInstance.close();
			};

			mod.cancel = function () {
			  $modalInstance.dismiss('cancel');
			};
		}

		function ModalPracticeHistory(_, $scope, $modalInstance, coreFns, user) {
			var mod = this,
					clockArr;

			mod.memberName = user.user.skater_name + ' ('+user.user.first_name+' '+user.user.last_name+')';

			console.log(user.user);

/*
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

			mod.toggleSort = function(selected) {
				mod.predicate = coreFns.toggle(selected, mod.predicate);
			}
*/
			mod.ok = function () {
			  $modalInstance.close();
			};

			mod.cancel = function () {
				console.log('hi');
			  $modalInstance.dismiss('cancel');
			};
		}

})();