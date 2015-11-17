(function() {

	'use strict';

	angular
		.module('denverTracking')
		.controller('Navigation', Navigation);

		function Navigation($location) {
			var nav = this,
				parseUrl;

			parseUrl = $location.absUrl().replace('http://drd-clock2.dev/', '');

			nav.activeUrl = 'dashboard';
			if (parseUrl.indexOf('members') > -1) nav.activeUrl = 'members';
			if (parseUrl.indexOf('clock-in') > -1) nav.activeUrl = 'clock-in';
			if (parseUrl.indexOf('waiver') > -1) nav.activeUrl = 'waiver';

		};

})();