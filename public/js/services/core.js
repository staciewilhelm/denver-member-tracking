(function() {

	'use strict';

	angular
		.module('denverTracking')
		.factory('core', core);

		function core() {

			var currentQuarter = moment().quarter(),
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
					};

			return {
				currentQuarter: currentQuarter,
				memberStatuses: memberStatuses,
				memberTypes: memberTypes,
				memberLevels: memberLevels,
				skaterLevels: skaterLevels,
				today: today,
				dateOptions: dateOptions,
				dateFormat: dateFormat,
				googleURLs: googleURLs
			};

		}

})();