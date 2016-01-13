(function() {

	'use strict';

	angular
		.module('denverTracking')
		.factory('coreData', coreData)
		.factory('coreFns', coreFns);

		function coreData() {
			var currentQuarter = moment().quarter(),
					currentYear = new Date().getFullYear(),
					allQuarters = [1, 2, 3, 4],
					upcomingYears = [{year: currentYear}],
					memberStatuses = ['Active', 'Suspended', 'Alumni', 'Retired', 'Pending'],
					memberTypes = ['Skater', 'Volunteer', 'Associate'],
					memberLevels = ['Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5', 'Level 6'],
					skaterLevels = ['Flight School', 'B', 'A-', 'A'],
					today = new Date(),
					dateOptions = {
						'year-format': 'yy',
						'starting-day': 1
					},
					dateFormat = 'MM/dd/yyyy',
					googleURLs = {
						groups: 'https://groups.google.com/a/denverrollerderby.org/forum/#!forum/',
						groupsSearch: 'https://groups.google.com/a/denverrollerderby.org/forum/#!forumsearch/',
						intranet: 'https://intranet.denverrollerderby.org',
						calendar: 'http://calendar.denverrollerderby.org',
						contacts: 'https://www.google.com/contacts/'
					}

			var nextCount = currentYear, nextIndex = 0;
			for (nextIndex = 0; nextIndex < 5; nextIndex++) {
				nextCount = nextCount + 1;
				upcomingYears.push({year: parseInt(nextCount)});
			}

			return {
				currentQuarter: currentQuarter,
				currentYear: currentYear,
				allQuarters: allQuarters,
				upcomingYears: upcomingYears,
				memberStatuses: memberStatuses,
				memberTypes: memberTypes,
				memberLevels: memberLevels,
				skaterLevels: skaterLevels,
				today: today,
				dateOptions: dateOptions,
				dateFormat: dateFormat,
				googleURLs: googleURLs
			};

		};

		function coreFns() {
			var toggle = function(selected, current, isObject) {
				if (isObject) {
					if (current[0].indexOf('-') === -1) {
						return ['-last_name', 'first_name'];
					} else {
						return ['last_name', 'first_name'];
					}
				} else {
					if (current === selected && current.indexOf('-') === -1) {
						return '-'+selected;
					} else {
						return selected;
					}
				}
			};

			return {
				toggle: toggle
			}
		}

})();