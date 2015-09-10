(function() {

	'use strict';

	angular
		.module('denverTracking')
		.controller('ModalCtrl', ['$modalInstance', ModalCtrl]);

		function ModalCtrl($modalInstance) {
			var mod = this;

			mod.items = ['hello', 'yeah', 'ok'];
			mod.selected = {
			  item: mod.items[0]
			};

			mod.ok = function () {
			  $modalInstance.close(mod.selected.item);
			};

			mod.cancel = function () {
				console.log('hi');
			  $modalInstance.dismiss('cancel');
			};
		}

})();